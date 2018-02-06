/**
 * @name VFS Angular App Controller
 *
 * @copyright (C) 2014-2015 Kibble Games Inc in cooperation with Vancouver Film School.  All Rights Reserved.
 * @author Scott Henshaw
 *
 */
'use_strict';

//import { Timer } from 'timer';

class AppController {

    constructor( TimerService ) {

        let myData = {
            id: "",
            loop: null,
        };
        __private__.set( this, myData );

        this.timer = TimerService; // allow other function uses Timer service

        // The View Model (vm) keeps clear the data the template can/should bind to
        this.vm = {
            title: "Trendz Wearhouse",
            author: " Bhavesh, Max, Erin"
        };
    }
}

/* -------------------------------------------------------------------------- */
// MAIN - start the whole thing off by creating the AppController
// Define the routing for the app using the UI router.

// stateProvider defines something
// state changes something

angular.module('app.controllers')
    .config(['$stateProvider', function( $stateProvider ) {

        $stateProvider
            .state({ name: 'Login',  url:  '/',      templateUrl: 'partials/index.html'}) // default
            .state({ name: 'Customer', url: '/customer', template: '<pg-customer-product title = "{{app.vm.title}}"></pg-customer-product>'})
            .state({ name: 'Inventory',   url:  '/inventory', template: '<pg-add-product title = "{{app.vm.title}}"></pg-add-product>'})
            .state({ name: 'Fulfillment',   url:  '/fulfillment', template: '<pg-fulfillment title = "{{app.vm.title}}"></pg-fulfillment>'});
    }])
    .run(['$state', function($state) {

        $state.transitionTo('Login');
    }])
    .controller('AppController', function() {

        return new AppController( TimerService );
    });

// controller cannnot see each other infomation
// if you want to share the infomation, you need to create service to hold the infomation
// for example, if you want to get login infomation, you need to access login service to get it
