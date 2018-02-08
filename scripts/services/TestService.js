/**
 * @name VFS Angular Timer
 * @desc The timer object is a class that manages a simple Angular interval timer
 * much like the setInterval in JavaScript.  Just a sample of what can be done.
 *
 *
 */
'use_strict';


class TestService {
	
	constructor() {
		
		this.theModelData = {
			attribute: "Some Value"
		};
	}
	
	get modelData() { return this.theModelData }
		
	populate() {
		// Go to a server and retrieve data to add to this.modelData.
	}
}

//Now lets regiseter a generic angular service for this
angular.module('app.services')
 	.service('TestService', function() {

 		return new TestService();
 	});

