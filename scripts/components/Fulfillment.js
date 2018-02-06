/**
 * @name VFS Angular Menu Component
 *
 * @copyright (C) 2014-2015 Kibble Games Inc in cooperation with Vancouver Film School.  All Rights Reserved.
 * @author Team Trendz (Bhavesh, Max, Erin)
 *
 */
'use_strict';

class FulfillmentController {

    // DOLLER sign means it expects angular obj
    constructor( $element, $attrs, DataService) {
        this.DataService = DataService;
        this.vm = {
            picklist : ""
        }
    }

    // # find products that related with the newest order which have not fulfilled
    // ## the order should be...
    // - order completed (order status is complete)
    // - not canceled (delete date is not null)
    // ## the ordered product should be...
    // - not fulfilled
    // - not canceled
    showPickList() {
        this.DataService.loadPickList()
          .then((data) => {
              if (data.picklist.length == 0) {
                  this.vm.picklist = data.picklist;
                  return;
              }

              if (data.picklist.length == 1) {

              }
              data.picklist.forEach((obj) => {
                  if (obj.REQUIRED_QTY > obj.ACTUAL_QTY) {
                      obj.enoughQty = false;
                  } else {
                      obj.enoughQty = true;
                  }
              });

              this.vm.picklist = data.picklist;
          });
    }

    // change the ordered product status to fulfilled
    // if all the order has fulfilled, change the order status to "ready to ship"
    fulfil( data ) {
        // decrease product num
        // update order product status
        // update order status
        // show new pickup list
        this.DataService.fulfill(data)
          .then((data) => {
              
              if (data.error == 0) {
                  alert("Fulfillment done!");
              } else {
                  alert("Fulfillment failed!");
              }

              this.showPickList();
          });
    }

}

angular.module('app.components')
    .component('pgFulfillment', {
        templateUrl: "partials/fulfillment.html",
        controller:['$element','$attrs', 'DataService', FulfillmentController],
        bindings:{}
    } );
