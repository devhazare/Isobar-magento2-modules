 define(['ko', 'uiComponent'], function(ko, Component) {
    'use strict';
    return Component.extend({
        defaults: {
             template: 'Isobar_FrontendPage/productrender'
        },
        initialize: function(config) {
             this._super();
             this.setProductData(config.items);
        },
        setProductData: function(items) {
         this.columnNames = ko.computed(function () {
              if (items.length === 0)
                  return [];
              var props = [];
              var obj = items[0];
              for (var name in obj)
                  props.push(name);
              return props;
          });
        }
    });
});