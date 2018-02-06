/**
 * @name VFS Angular Menu Component
 *
 * @copyright (C) 2014-2015 Kibble Games Inc in cooperation with Vancouver Film School.  All Rights Reserved.
 * @author Scott Henshaw
 *
 */
'use_strict';


class AddProductController {

    // DOLLER sign means it expect angular obj
    constructor( $element, $attrs, DataService) {
        this.data = DataService;
        this.vm = {
            products : "",
            types: "",
            color: ""
        }
    }

    add(data) {
        //angular.copy(formData, this.vm.formData);
        this.data.saveProduct(data)
            .then((data) => {

                // this will get called/resolved when data arrives in the Service
            });
    }

    getType() {
        this.data.getType()
            .then((data) => {
                this.vm.types = data.types;
            });

    }
    getColor() {
        this.data.getColor()
            .then((data) => {
                this.vm.color = data.color;
            });
    }
    loadAll() {
        this.data.loadAllProducts()
          .then((data) => {
              // do something here
              this.vm.products = data.products;
              console.log(this.vm.products);

          })
    }

    edit (data) {
        this.vm.products.forEach((obj) => {
            if (obj.ID == data.ID) {//todo
                obj.editFlg = true;
            }
        });
    }


    updatebyId(data){
        let dataToServer = {};
        this.vm.products.forEach((obj) => {
            if (obj.ID == data.ID) {//todo
                dataToServer.id = data.ID;
                dataToServer.name = data.NAME;
                dataToServer.aisle_num = data.AISLE_NUM;
                dataToServer.quantity = data.QUANTITY;
                dataToServer.retail_price = data.RETAIL_PRICE;
                dataToServer.whole_sale_price = data.WHOLE_SALE_PRICE;
                dataToServer.type = data.TYPE;
                dataToServer.color = data.COLOR;
            }
        });

      this.data.updateProduct(dataToServer)
      .then((data) => {
          this.loadAll();

      });
  }

}

angular.module('app.components')
    .component('pgAddProduct', {
        templateUrl: "partials/inventoryView.html",
        controller:['$element','$attrs', 'DataService',AddProductController],
        bindings:{}
    } );
