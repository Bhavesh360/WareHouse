/**
 * Angular Module Definitions
 *
 *
 */
'use strict';
const __private__ = new WeakMap();

/*
 * Module definitions
 *
 * Declaring multiple 'containers' for various app components allows
 * us to have a much larger app without the complexity.
 * These statements create empty - no dependency namespaces within the
 * angular system.
 *
 */
angular.module('app.components',[]);
angular.module('app.controllers',[]);
angular.module('app.directives',[]);
angular.module('app.services', []);


/*
 * Declare the app itself and all the dependencies it relies on
 * This can later be used to add routing or other service providers.
 * Angular constructs to add modular functionality to an APP
 */
var app = angular.module('app', [   // list modules that we depend on.
    'ui.router',
    
     'app.services',
     'app.directives',
     'app.components',
     'app.controllers',
]);


