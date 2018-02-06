/**
 * Angular Services - DataService
 *
 * @copyright: (C) 2016 Kibble Games Inc in cooperation with Vancouver Film School.  All Rights Reserved.
 * @author: Scott Henshaw
 *
 */
 'use strict';

// import ???

class DataService {

    constructor( $http, $q, $httpParamSerializerJQLike) {

        this.appid = "";

        __private__.set( this, this.appid );

        // Service Providers
        this.http =           $http;
        this.promise = $q;
        this.httpSerializer = $httpParamSerializerJQLike;

        // public view model.  Use these in templates.
        this.vm = {
            username:    "",
            id:          "",
            orderList:   [],
            productList: []
        };
    }

    loadAllProducts() {
        let callback = this.promise.defer();
        let my = __private__.get( this ); // retrieve pseudo private data

        this.http.post('server/read_all_products/', "all" )
            .then( ( obj ) => {

                let response = obj.data;
                console.log(response);
                // this.vm.productList = response.payload;

                callback.resolve(response);
            });

        return callback.promise;
    }

    createOrder( orderItems ){
      let callback = this.promise.defer();
      let my = __private__.get( this ); // retrieve pseudo private data

      let pData = this.httpSerializer( orderItems );
      this.http.post('server/add_order/', orderItems )
          .then( ( obj ) => {
              let response = obj.data;
              console.log(response);
              callback.resolve(response);
          });
      return callback.promise;
    }

    loadProductsByType( aType) { // RENAME ME ! /////CHECK THIS OUT FOR SAVING DATA THROUGH FILTER THAT YOU NEED TO MAKE!!! MAYBE FILL OUT THE DATABASE FIRST!!!
        let callback = this.promise.defer();
        let my = __private__.get( this ); // retrieve pseudo private data

        let pData = this.httpSerializer( aType );
        this.http.post('server/read_products_by_type/', pData )
            .then( ( obj ) => {

                let response = obj.data;
                console.log(response);
                // this.vm.productList = response.payload;

                callback.resolve(response);
            });
        return callback.promise;
    }

    saveProduct( aProduct ) { // RENAME ME !

        let callback = this.promise.defer();
        // this.lastProduct =

        let my = __private__.get( this );// retrieve pseudo private data

        let pData = this.httpSerializer( aProduct );
        this.http.post("server/add_product/", pData )
            .then( ( result ) => {

                let p = result.data;
                console.log(p);
                //document.querySelector("#debug").innerHTML = result.data;
                // find a way to notify  the caller that their data is ready
                callback.resolve(p);
            });
        return callback.promise;
    }

    updateProduct( aProduct){

      let callback = this.promise.defer();
      // this.lastProduct =


      let my = __private__.get( this );//retrieve pseudo private data

      let pData = this.httpSerializer( aProduct );
      this.http.post("server/update_product/", pData )
          .then( ( result ) => {
              let p = result.data;
              //find a way to notify  the caller that their data is ready
              callback.resolve(p);
          });
          return callback.promise;
    }

    loadPickList() {
        let callback = this.promise.defer();
        let my = __private__.get( this ); // retrieve pseudo private data
        this.http.post('server/load_pick_list/', "one" )
            .then( ( obj ) => {
                let response = obj.data;
                console.log(response);
                callback.resolve(response);
            });
        return callback.promise;
    }

    fulfill( aData ){
      let callback = this.promise.defer();
      let my = __private__.get( this );// retrieve pseudo private data
      let pData = this.httpSerializer( aData );
      this.http.post("server/fulfill/", pData )
          .then( ( result ) => {
              let response = result.data;
              console.log(response);
              callback.resolve(response);
          });
          return callback.promise;
    }

    getType(){
      let callback = this.promise.defer();
      this.http.post("server/get_type/", "all" )
          .then( ( result ) => {
              let response = result.data;
              console.log(response);
              callback.resolve(response);
          });
          return callback.promise;
    }
    getColor(){
      let callback = this.promise.defer();
      this.http.post("server/get_color/", "all" )
          .then( ( result ) => {
              let response = result.data;
              console.log(response);
              callback.resolve(response);
          });
          return callback.promise;
    }
}
// export default DataService;

angular.module('app.services')
	.config( function( $httpProvider ) {

        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    })
    .service('DataService', ['$http', '$q', '$httpParamSerializerJQLike', function( $http, $q, $httpParamSerializerJQLike ) { // q service is promise wrap in angular

        return new DataService( $http, $q, $httpParamSerializerJQLike );
    }]);
