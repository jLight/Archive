

// changed parameters
window.addEvent('load', function(){
	var config = ["admintable", "adminForm", "adminform"];
	
	// get elements
	config.each(function(ch,j){
		string = (
			"." + ch + " input[type!=hidden], " +
			"." + ch + " textarea, " +
			"." + ch + " select"
		);
		
		if (j == 0) {
			changeables = document.getElementsBySelector(string);
		} else {
			changeables.merge(document.getElementsBySelector(string));
		}
	});
	
	/*
	changeables = document.getElementsBySelector('.admintable input, .admintable textarea, .admintable select'); // , .adminlist input');
	changeables.merge(document.getElementsBySelector('.adminForm input, .adminForm textarea, .adminForm select'));
	changeables.merge(document.getElementsBySelector('.adminform input, .adminform textarea, .adminform select'));
	/* */
	// changeables.merge(document.getElementsBySelector('.paramlist input, .paramlist textarea, .paramlist select')); // component
		
	if (typeof changeables != 'undefined' && !changeables.length<1){
	
	
		var undo = []; // array of elements that changed its state
		var redo = [];
		
		// change element's and alement's row classes
		var switchC = function(el, state){
			if (typeof state == 'undefined') state = 0;

			// if el.retrieve("data-row") what = el.retrieve("data-row"); else... // MT1.2+ check for row reference
			
			state == 1 ? el.addClass("change") : el.removeClass("change");
			
			/*
			if (el.getProperty('type') == "radio" || el.getProperty('type') == "checkbox") {
				// changeables.
				label = document.getElement('label[for="'+el.getProperty('id')+'"]');
				console.log(label);
				state == 1 ? label.addClass("change") : label.removeClass("change");
			}
			*/
			
			// traverse up to look for param row (cannot access directly because of custom custom elements styling)
			
			// what = el.getParent('.paramlist_value').getParent('tr');
			var what = el;
			while(
				/*
				(function(){
					config.each(function(ch){
						if (what.getParent().getParent().hasClass(ch)){
							alert('x');
							return true;
						}
					});
				})()
				*/
				
				!what.getParent().getParent().hasClass("admintable")
				&& !what.getParent().getParent().hasClass("adminForm")
				&& !what.getParent().getParent().hasClass("adminform")
				
				// || !what.getParent("tbody").getParent("table.adminlist").hasClass("adminlist")
			){
				what = what.getParent();
				if (what == document.body) return false;
			}
			// MT1.2+: el.store('data-row', what); // store row reference
			
			state == 1 ? what.addClass("change") : what.removeClass("change");

			return;
		}
		
		// set default value
		changeables.each(function(el,i){
			if (el.getProperty('value') && !el.getProperty('data-previous')){
				
				if ((el.getProperty('type') == "radio" || el.getProperty('type') == "checkbox") && !el.checked){
					
					el.setProperty('data-previous', "");
					/*
					// get other radios
					dataOptions = document.getElementsByName(el.getProperty('name'));
					
					// set default value from the checked radio
					$each(dataOptions, function(el2,i2){
					// dataOptions.each(function(el2,i2){
						if(el2.checked){
							dataDefault = el2.getProperty("value");
							el.setProperty('data-previous', el2.getProperty("value"));
							return;
						}
					});
					*/
				} else {
					el.setProperty('data-previous', el.getProperty("value"));
				}
			} else if (!el.getProperty("value")) {
				el.setProperty('data-previous', "");
			}
		});
		
		
	
	
		// reset
		var reset = new Element('td', {
			'id': "toolbar-undo",
			'class': "button"
		});
		reset.injectTop(document.getElement('#toolbar table.toolbar tr'));
	
		var undoButton = new Element('a', {
			'class': "toolbar",
			// 'html': "Undo", // not in MT1.1
			// 'text': "Undo", // not in MT1.1
			'href': "#",
			'events': {
				'click': function(e) {
					e = new Event(e).stop();
					if (undo.length > 0){
						if (e.alt || e.shift){ // alt / control / shift / rightClick
							undo.each(function(el,i){
								el.fireEvent('undo');
							});
							redo = undo;
							undo = [];
						} else {
							el = undo.getLast();
							el.fireEvent('undo');
							redo.include(el);
							undo.remove(el);
						}
						if (undo.length < 1) {
							this.removeClass("on");
						}
					}
				}
			}
		}).injectTop(reset).adopt(
			new Element('span', {
				'class': "icon-32-move",
				'title': "Undo"
			})
		).innerHTML += "Undo";
		
		undoButton = document.getElement('#toolbar-undo a.toolbar'); // to be sure
		
		// add events
		changeables.addEvents({
			'change': function(){
				// if (this.getParent('paramlist_value').getParent('tr').getTag() == "tr"){
				if (
					(this.getProperty('type') == "checkbox" && this.checked == this.getProperty("data-previous")
						/* (!this.checked && this.getProperty("data-previous") != "") ||
						(this.checked && this.getProperty("data-previous") == "") */
					) ||
					(this.getProperty("value") != this.getProperty("data-previous"))
				){
					// switch ON
					switchC(this, 1);
					undo.include(this);
					undoButton.addClass("on");
				} else {
					// switch OFF
					switchC(this);
					undo.remove(this);
					if (undo.length < 1) {
						undoButton.removeClass("on");
					}
				}
				redo = []; // reset redo
			},
			'undo': function(){
				if (this.getProperty("type") == "checkbox"){
					this.checked = this.getProperty("data-previous") == "" ? false : true;
				} else if (this.getProperty("type") == "radio"){
					$each(document.getElementsByName(this.getProperty("name")), function(el3,i3){
						el3.checked = el3.getProperty("data-previous") == "" ? false : true;
					});
				} else {
					this.value = this.getProperty("data-previous");
				}
				switchC(this);
				// undo.remove(this); conflict with each
			}
		});
		
		
		// uncheck when cancel pressed
		if (document.getElement('#toolbar-cancel')){
			document.getElement('#toolbar-cancel').addEvents({
				'click': function(){
					if (undo.length > 0){
						undo.each(function(el,i){
							el.fireEvent('undo');
						});
						redo = undo;
						undo = [];
						/*
						undo.each(function(el,i){
							switchC(el);
						});
						*/
					}
				}
			});
		}
	}
	
});