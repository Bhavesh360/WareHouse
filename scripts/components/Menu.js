/**
 * @name VFS Angular Menu Component
 *
 * @copyright (C) 2014-2015 Kibble Games Inc in cooperation with Vancouver Film School.  All Rights Reserved.
 * @author Scott Henshaw
 *
 */

'use_strict';

class MenuComponentController {

    constructor($state) {
        this.state = $state;
        this.content = ['Customer','Inventory', 'Fulfillment']; // list of different pages
        this.currentPage = 'Login';
    }

    // update currentPage
    setPage( page ) {
        this.state.transitionTo( page );
        this.currentPage = page;
    }
}

angular.module('app.components')
    .component('pgMenu', {
        template: `
            <nav>
                <div class="current-page">Current Page: {{ $ctrl.currentPage }} </div>
                <ul>
                    <li ng-repeat="page in $ctrl.content" class="menuitem">
                        <button ng-click="$ctrl.setPage( page )">{{page}}</button>
                    </li>
                </ul>
            </nav>`,
        controller: ['$state', MenuComponentController ],
        bindings: {
            currentPage: "@" // ask Robert or Scott wooooooo!!!
        }
    });


// controller is an entire page
// component is a portion of a page
