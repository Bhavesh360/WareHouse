// Directive can be used globaly
// After building the component and found something duplicated again and again,
// maybe it will be better to use directive

// html sample
// <li ng-repeat="brabra in braaaaaa" value="{{prod.id}}">
//   <wh-product-detail product="prod" hilite="prod.color"></wh-product-detail>
// </li>

class ProductDetail {
    constructor() {
        // aware the item
        this.scope = {
            product: '='
        }

        this.template = `
            <input type="text" name="product_name" ng-model="product.name" />
        `;

        /*
        template:
        templateUrl:  The HTML bit.

        restrict  => String of subset of 'EACM' which restricts the directive
                      to a specific directive declaration style. If omitted,
                      the defaults (elements and attributes) are used.

                    E - Element name (default): <my-directive></my-directive>
                    A - Attribute (default): <div my-directive="exp"></div>
                    C - Class: <div class="my-directive: exp;"></div>
                    M - Comment: <!-- directive: my-directive exp
        */

        this.restrict = 'E';
    }

    link(scope, iElement, iAttrs, $ctrl) {

    }
}

angular.module('app.directives').directive('wh-inventory', ProductDetail);
