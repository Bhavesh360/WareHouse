/**
 * @name VFS Angular Component
 *
 * @copyright (C) 2014-2017 Kibble Games Inc in cooperation with Vancouver Film School.  All Rights Reserved.
 * @author Scott Henshaw
 *
 */
'use strict';

class CustomerViewController {


      // DOLLER sign means it expect angular obj
      constructor( $element, $attrs, DataService) {
          this.data = DataService;
          this.cartItems =[];
          this.vm = {
              id : ":D",
              products : ""
          }
      }


    loadbyType(data) {
        this.data.loadProductsByType(data)
          .then((data) => {
              // do something here
              this.vm.products = data.products;
              console.log(this.vm.products);
          })
    }

    addItemsToCart(data){
      var cartItem = angular.copy(data);

      cartItem.QUANTITY = 1;
      cartItem['AVAILIBILITY'] = "AVAILABLE";
      var flag = true;
      if(data.QUANTITY> 0){
      if(this.cartItems.length<1){
        this.cartItems.push(cartItem);
      }
      else{
          for(var i= 0; i<this.cartItems.length; i++){
              if(cartItem.ID === this.cartItems[i].ID){
                if(this.cartItems[i].QUANTITY<data.QUANTITY ){
                this.cartItems[i].QUANTITY++;
                }
                else{
                  this.cartItems[i].AVAILIBILITY = "NOT AVAILABLE";
                }
                flag = false;
            }

          }
          if(flag === true){
            this.cartItems.push(cartItem);
          }
      }
      console.log(this.cartItems);
    }
    }

    confirmOrder(){
      this.data.createOrder(this.cartItems)
      .then((data) =>{

          alert("THANK YOU FOR YOUR ORDER");
        
        // maybe display some message
      })
    }

    getType() {
        this.data.getType()
            .then((data) => {
                this.vm.types = data.types;
            });
    }

}


angular.module('app.components')
    .component('pgCustomerProduct', {
        templateUrl: "partials/CustomerView.html",
        controller:['$element','$attrs', 'DataService',CustomerViewController],
        bindings:{}
    } );
