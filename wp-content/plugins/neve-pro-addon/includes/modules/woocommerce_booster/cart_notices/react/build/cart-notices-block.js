!function(e){var t={};function n(r){if(t[r])return t[r].exports;var c=t[r]={i:r,l:!1,exports:{}};return e[r].call(c.exports,c,c.exports,n),c.l=!0,c.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var c in e)n.d(r,c,function(t){return e[t]}.bind(null,c));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=20)}([function(e,t){e.exports=window.wp.element},function(e,t){e.exports=window.wp.i18n},function(e,t){e.exports=window.wp.components},function(e,t){e.exports=window.wp.blockEditor},function(e,t){e.exports=window.wp.data},function(e,t){e.exports=function(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){function n(){return e.exports=n=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(e[r]=n[r])}return e},e.exports.default=e.exports,e.exports.__esModule=!0,n.apply(this,arguments)}e.exports=n,e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=window.wp.richText},function(e,t){e.exports=window.wp.url},function(e,t){e.exports=window.wp.hooks},function(e,t,n){var r=n(15),c=n(16),o=n(17),a=n(19);e.exports=function(e,t){return r(e)||c(e,t)||o(e,t)||a()},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=window.lodash},function(e,t){e.exports=window.wp.compose},function(e,t){e.exports=window.wp.blocks},function(e,t){e.exports=window.wp.apiFetch},function(e,t){e.exports=function(e){if(Array.isArray(e))return e},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=function(e,t){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(e)){var n=[],_n=!0,r=!1,c=void 0;try{for(var o,a=e[Symbol.iterator]();!(_n=(o=a.next()).done)&&(n.push(o.value),!t||n.length!==t);_n=!0);}catch(e){r=!0,c=e}finally{try{_n||null==a.return||a.return()}finally{if(r)throw c}}return n}},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t,n){var r=n(18);e.exports=function(e,t){if(e){if("string"==typeof e)return r(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);return"Object"===n&&e.constructor&&(n=e.constructor.name),"Map"===n||"Set"===n?Array.from(e):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?r(e,t):void 0}},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=function(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t){e.exports=function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")},e.exports.default=e.exports,e.exports.__esModule=!0},function(e,t,n){"use strict";n.r(t);var r=n(0),c=n(12),o=n(2),a=n(9),l=n(3),i=n(1);Object(a.addFilter)("blocks.registerBlockType","neve/custom-attributes",(function(e,t){return"core/button"!==t||void 0!==e.attributes&&(e.attributes=Object.assign(e.attributes,{autoAddToCart:{type:"boolean",default:!1},autoApplyDiscount:{type:"boolean",default:!1},discountCode:{type:"string"}})),e}));var u=Object(c.createHigherOrderComponent)((function(e){return function(t){if("core/button"!==t.name)return Object(r.createElement)(e,t);var n=t.attributes,c=t.setAttributes,a=t.isSelected,u=n.autoAddToCart,s=n.autoApplyDiscount,_=n.discountCode;return Object(r.createElement)(r.Fragment,null,Object(r.createElement)(e,t),a&&Object(r.createElement)(l.InspectorControls,null,Object(r.createElement)(o.PanelBody,{title:Object(i.__)("Advanced link settings","neve")},Object(r.createElement)(o.ToggleControl,{label:Object(i.__)("Automatically add to cart"),checked:!!u,onChange:function(){return c({autoAddToCart:!u})},help:Object(i.__)("This works if the button uses a product link.","neve")}),u&&Object(r.createElement)(r.Fragment,null,Object(r.createElement)(o.ToggleControl,{label:Object(i.__)("Automatically apply discount"),checked:!!s,onChange:function(){return c({autoApplyDiscount:!s})}}),s&&Object(r.createElement)(o.TextControl,{label:Object(i.__)("Discount code","neve"),value:_,onChange:function(e){return c({discountCode:e})}})))))}}),"withAdvancedControls");Object(a.addFilter)("editor.BlockEdit","neve/cart-notice-advanced-button",u);var s=n(4),_=n(7),b=function(e){var t=Object(s.useSelect)((function(e){return{selectionStart:e("core/block-editor").getSelectionStart(),selectionEnd:e("core/block-editor").getSelectionEnd(),block:e("core/block-editor").getSelectedBlock()}})),n=t.selectionStart,c=t.selectionEnd,a=t.block,u=e.getMetaValue,b=Object(s.useDispatch)("core/block-editor").updateBlock,g=[{name:"{time_left}",isActive:!!u("nv_cn_expiration_end")},{name:"{amount_left}",isActive:!("amount"!==u("nv_cn_trigger")||!u("nv_cn_trigger_amount_max"))},{name:"{products_in_cart}",isActive:!("product"!==u("nv_cn_trigger")||!u("nv_cn_trigger_product_include")||!JSON.parse(u("nv_cn_trigger_product_include")).length)},{name:"{quantity_left}",isActive:!("product"!==u("nv_cn_trigger")||!u("nv_cn_trigger_product_max_qty"))},{name:"{quantity_over}",isActive:!("product"!==u("nv_cn_trigger")||!u("nv_cn_trigger_product_min_qty"))},{name:"{categories_in_cart}",isActive:!("category"!==u("nv_cn_trigger")||!u("nv_cn_trigger_category_include")||!JSON.parse(u("nv_cn_trigger_category_include")).length)}].filter((function(e){return!0===e.isActive}))||[];return Object(r.createElement)(l.BlockControls,null,Object(r.createElement)(o.ToolbarGroup,null,Object(r.createElement)(o.ToolbarItem,null,(function(e){return Object(r.createElement)(o.DropdownMenu,{className:"nv-magic-tags-dropdown",icon:"image-filter",label:Object(i.__)("Magic tags","neve"),toggleProps:e},(function(){return Object(r.createElement)(o.MenuGroup,null,g.length>0?Object(r.createElement)(r.Fragment,null,g.map((function(e,t){return Object(r.createElement)(o.MenuItem,{onClick:function(){var t=a.clientId,r=n.offset,o=c.offset,l=a.attributes.content,i=Object(_.create)({html:l});i=Object(_.insert)(i,e.name,r,o),b(t,{attributes:{content:Object(_.toHTMLString)({value:i})}})},key:t},e.name)}))):Object(r.createElement)(o.MenuItem,null,Object(i.__)("There are no available magic tags for this notice.","neve")))}))}))))},g=n(13),d=n(6),p=n.n(d),m=n(5),v=n.n(m),f=function(e){var t=e.getMetaValue,n=e.setMetaValue;return Object(r.createElement)(o.PanelBody,{title:Object(i.__)("Display location","neve"),initialOpen:!0},Object(r.createElement)(o.ToggleControl,{label:Object(i.__)("Show on cart","neve"),checked:!!t("nv_cn_location_cart")&&JSON.parse(t("nv_cn_location_cart")),onChange:function(e){n("nv_cn_location_cart",e)}}),Object(r.createElement)(o.ToggleControl,{label:Object(i.__)("Show on checkout","neve"),checked:!!t("nv_cn_location_checkout")&&JSON.parse(t("nv_cn_location_checkout")),onChange:function(e){n("nv_cn_location_checkout",e)}}),Object(r.createElement)(o.ToggleControl,{label:Object(i.__)("Show on product catalog","neve"),checked:!!t("nv_cn_location_shop")&&JSON.parse(t("nv_cn_location_shop")),onChange:function(e){n("nv_cn_location_shop",e)}}),Object(r.createElement)(o.ToggleControl,{label:Object(i.__)("Show on single product","neve"),checked:!!t("nv_cn_location_single")&&JSON.parse(t("nv_cn_location_single")),onChange:function(e){n("nv_cn_location_single",e)}}))},O=function(e){var t=e.getMetaValue,n=e.setMetaValue;return Object(r.createElement)(o.PanelBody,{title:Object(i.__)("Display settings","neve"),initialOpen:!1},Object(r.createElement)(o.SelectControl,{label:Object(i.__)("Display notice for:","neve"),options:[{label:Object(i.__)("All users","neve"),value:"all"},{label:Object(i.__)("Registered users","neve"),value:"registered"}],onChange:function(e){n("nv_cn_user_status",e)},value:t("nv_cn_user_status")?t("nv_cn_user_status"):"all"}),Object(r.createElement)(o.PanelRow,null,Object(r.createElement)("span",null,Object(r.createElement)("strong",null,Object(i.__)("Start date:","neve"))),Object(r.createElement)(o.Dropdown,{className:"nv-cn-expiration-start",position:"bottom right",renderToggle:function(e){var n=e.isOpen,c=e.onToggle;return Object(r.createElement)(o.Button,{isTertiary:!0,onClick:c,"aria-expanded":n},t("nv_cn_expiration_start")?t("nv_cn_expiration_start"):Object(i.__)("Immediately","neve"))},renderContent:function(){return Object(r.createElement)(o.DateTimePicker,{currentDate:t("nv_cn_expiration_start")?t("nv_cn_expiration_start"):"",onChange:function(e){var t=null!==e?moment(e).format("MMMM D, YYYY HH:mm"):"";n("nv_cn_expiration_start",t)}})}})),Object(r.createElement)(o.PanelRow,null,Object(r.createElement)("span",null,Object(r.createElement)("strong",null,Object(i.__)("End date:","neve"))),Object(r.createElement)(o.Dropdown,{className:"nv-cn-expiration-end",position:"bottom right",renderToggle:function(e){var n=e.isOpen,c=e.onToggle;return Object(r.createElement)(o.Button,{isTertiary:!0,onClick:c,"aria-expanded":n},t("nv_cn_expiration_end")?t("nv_cn_expiration_end"):Object(i.__)("No date defined","neve"))},renderContent:function(){return Object(r.createElement)(o.DateTimePicker,{currentDate:t("nv_cn_expiration_end")?t("nv_cn_expiration_end"):"",onChange:function(e){var t=null!==e?moment(e).format("MMMM D, YYYY HH:mm"):"";n("nv_cn_expiration_end",t)}})}})))},j=n(10),y=n.n(j),h=n(14),x=n.n(h);function E(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function w(e){return(w="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function C(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function S(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?C(n,!0).forEach((function(t){E(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):C(n).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var k={adminUrl:"",countries:[],currency:{code:"USD",precision:2,symbol:"$",symbolPosition:"left",decimalSeparator:".",priceFormat:"%1$s%2$s",thousandSeparator:","},defaultDateRange:"period=month&compare=previous_year",locale:{siteLocale:"en_US",userLocale:"en_US",weekdaysShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"]},orderStatuses:[],siteTitle:"",wcAssetUrl:""},T=S({},k,{},"object"===("undefined"==typeof wcSharedSettings?"undefined":w(wcSharedSettings))?wcSharedSettings:{});function M(e){var t=arguments.length>1&&void 0!==arguments[1]&&arguments[1];return T.hasOwnProperty(e)?T[e]:t}T.currency=S({},k.currency,{},T.currency),T.locale=S({},k.locale,{},T.locale),T.adminUrl,T.countries,T.currency,T.locale,T.orderStatuses,T.siteTitle,T.wcAssetUrl,T.defaultDateRange;var P=n(8),A=n(11);function N(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function D(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?N(Object(n),!0).forEach((function(t){v()(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):N(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var B=function(e){var t=e.getMetaValue,n=e.setMetaValue,c=Object(r.useState)({}),a=y()(c,2),l=a[0],u=a[1],s=Object(r.useState)({}),_=y()(s,2),b=_[0],g=_[1];function d(e){var t,n=e.type,r=void 0===n?"products":n,c=e.queryArgs,o=void 0===c?[]:c;return"products"===r&&(t=function(e){var t=e.queryArgs,n=void 0===t?[]:t,r={per_page:M("isLargeCatalog")?100:0,catalog_visibility:"any",orderby:"title",order:"asc"},c=[Object(P.addQueryArgs)("/wc/store/products",D(D({},r),n))];return M("isLargeCatalog")&&c.push(Object(P.addQueryArgs)("/wc/store/products",{catalog_visibility:"any"})),c}({queryArgs:o})),"categories"===r&&(t=function(e){var t=e.queryArgs,n=void 0===t?[]:t;return[Object(P.addQueryArgs)("/wc/store/products/categories",D(D({},{per_page:0}),n))]}({queryArgs:o})),Promise.all(t.map((function(e){return x()({path:e})}))).then((function(e){var t=[];return Object(A.uniqBy)(Object(A.flatten)(e),"id").forEach((function(e){t.push({value:e.id,title:e.name})})),t})).catch((function(e){throw e}))}Object(r.useEffect)((function(){var e=!0;return d({type:"products"}).then((function(t){var n=t.reduce((function(e,t){return D(D({},e),{},v()({},t.title,t.value))}),{});e&&u(n)})).catch((function(e){return console.log(e)})),d({type:"categories"}).then((function(t){var n=t.reduce((function(e,t){return D(D({},e),{},v()({},t.title,t.value))}),{});e&&g(n)})).catch((function(e){return console.error(e)})),function(){return e=!1}}),[]);var p=function(e){switch(e){case"no-trigger":return Object(i.__)("The notice is always present on the selected locations.","neve");case"amount":return Object(i.__)("The notice is shown based on cart amount.","neve");case"product":return Object(i.__)("The notice is shown based on what products are in cart and/or their number.","neve");case"category":return Object(i.__)("The notice is shown based on categories of products that are in cart.","neve");default:return""}}(t("nv_cn_trigger"));function m(e,t){var r=arguments.length>2&&void 0!==arguments[2]&&arguments[2],c=[],o=r?b:l;e.forEach((function(e){var t="string"==typeof e?o[e]:e.id;t&&c.push({id:t,value:"string"==typeof e?e:e.value})})),n(t,JSON.stringify(c))}return Object(r.createElement)(r.Fragment,null,Object(r.createElement)(o.PanelBody,{title:Object(i.__)("Display conditions","neve"),initialOpen:!1},Object(r.createElement)(o.BaseControl,{className:"nv-cn-trigger",help:p},Object(r.createElement)(o.SelectControl,{options:[{label:Object(i.__)("Always","neve"),value:"no-trigger"},{label:Object(i.__)("Cart amount","neve"),value:"amount"},{label:Object(i.__)("Product in cart","neve"),value:"product"},{label:Object(i.__)("Category in cart","neve"),value:"category"}],onChange:function(e){n("nv_cn_trigger",e)},value:t("nv_cn_trigger")?t("nv_cn_trigger"):"no-trigger"})),Object(r.createElement)(o.Dropdown,{className:"nv-cn-magic-tags",position:"bottom right",renderToggle:function(e){var t=e.isOpen,n=e.onToggle;return Object(r.createElement)(o.Button,{isLink:!0,onClick:n,"aria-expanded":t},Object(i.__)("How to add magic tags","neve"))},renderContent:function(){return Object(r.createElement)("div",{className:"nv-cn-magic-tags-info"},Object(r.createElement)("p",null," ",Object(i.__)("Based on your notice settings, different magic tags will be available for you to add.","neve")," "),Object(r.createElement)("h4",null,Object(i.__)("How to add magic tags","neve")),Object(r.createElement)("p",null," ",Object(i.__)("Click on the text notice and a toolbar will be available.","neve")," "),Object(r.createElement)("p",null,void 0!==r.createInterpolateElement&&Object(r.createInterpolateElement)(Object(i.__)("Click on <span></span> and the list with magic tags will be available. Click on any tag to insert it in your text.","neve"),{span:Object(r.createElement)("span",{className:"dashicon dashicons dashicons-image-filter"})})),Object(r.createElement)("img",{src:neveCartNotice.magicTagInfoImage,alt:Object(i.__)("Magic tags","neve")}))}}),function(e){switch(e){case"amount":return Object(r.createElement)(r.Fragment,null,Object(r.createElement)(o.TextControl,{label:Object(i.__)("Maximum cart amount","neve"),type:"number",value:t("nv_cn_trigger_amount_max")?t("nv_cn_trigger_amount_max"):"",onChange:function(e){e=parseInt(e)<0?"0":e;var r=t("nv_cn_trigger_amount_min");e=parseInt(e)<parseInt(r)?r:e,n("nv_cn_trigger_amount_max",e)},min:0}),Object(r.createElement)(o.TextControl,{label:Object(i.__)("Minimum cart amount","neve"),type:"number",value:t("nv_cn_trigger_amount_min")?t("nv_cn_trigger_amount_min"):"",onChange:function(e){e=parseInt(e)<0?"0":e;var r=t("nv_cn_trigger_amount_max");e=parseInt(e)>parseInt(r)?r:e,n("nv_cn_trigger_amount_min",e)},min:0}),Object(r.createElement)(o.SelectControl,{label:Object(i.__)("Should include tax","neve"),options:[{label:Object(i.__)("No","neve"),value:"no"},{label:Object(i.__)("Yes","neve"),value:"yes"}],onChange:function(e){n("nv_cn_trigger_amount_tax",e)},value:t("nv_cn_trigger_amount_tax")?t("nv_cn_trigger_amount_tax"):"yes"}));case"product":return Object(r.createElement)(r.Fragment,null,Object(r.createElement)(o.BaseControl,{id:"nv-cn-product-include",label:Object(i.__)("Include","neve"),help:Object(i.__)("The notice is shown when any of the products from the list is in the cart.","neve"),className:"nv-products-control"},Object(r.createElement)(o.FormTokenField,{value:t("nv_cn_trigger_product_include")?JSON.parse(t("nv_cn_trigger_product_include")):[],suggestions:Object.keys(l),onChange:function(e){return m(e,"nv_cn_trigger_product_include")}})),Object(r.createElement)(o.BaseControl,{id:"nv-cn-product-exclude",label:Object(i.__)("Exclude","neve"),help:Object(i.__)("The notice is shown when none of the products from the list is in the cart.","neve"),className:"nv-products-control"},Object(r.createElement)(o.FormTokenField,{value:t("nv_cn_trigger_product_exclude")?JSON.parse(t("nv_cn_trigger_product_exclude")):[],suggestions:Object.keys(l),onChange:function(e){return m(e,"nv_cn_trigger_product_exclude")}})),Object(r.createElement)(o.TextControl,{label:Object(i.__)("Minimum quantity","neve"),type:"number",value:t("nv_cn_trigger_product_min_qty")?t("nv_cn_trigger_product_min_qty"):"",onChange:function(e){n("nv_cn_trigger_product_min_qty",e)},min:0}),Object(r.createElement)(o.TextControl,{label:Object(i.__)("Maximum quantity","neve"),type:"number",value:t("nv_cn_trigger_product_max_qty")?t("nv_cn_trigger_product_max_qty"):"",onChange:function(e){n("nv_cn_trigger_product_max_qty",e)},min:0}));case"category":return Object(r.createElement)(r.Fragment,null,Object(r.createElement)(o.BaseControl,{id:"nv-cn-category-include",label:Object(i.__)("Include","neve"),help:Object(i.__)("The notice is shown when any of the products from cart is in a category from this list.","neve"),className:"nv-products-control"},Object(r.createElement)(o.FormTokenField,{value:t("nv_cn_trigger_category_include")?JSON.parse(t("nv_cn_trigger_category_include")):[],suggestions:Object.keys(b),onChange:function(e){return m(e,"nv_cn_trigger_category_include",!0)}})),Object(r.createElement)(o.BaseControl,{id:"nv-cn-category-exclude",label:Object(i.__)("Exclude","neve"),help:Object(i.__)("The notice is shown when any of the products from cart is not in a category from this list.","neve"),className:"nv-products-control"},Object(r.createElement)(o.FormTokenField,{value:t("nv_cn_trigger_category_exclude")?JSON.parse(t("nv_cn_trigger_category_exclude")):[],suggestions:Object.keys(b),onChange:function(e){return m(e,"nv_cn_trigger_category_exclude",!0)}})));default:return""}}(t("nv_cn_trigger"))))},I=function(e){var t=e.attributes,n=e.setAttributes,c=t.backgroundColor;return Object(r.createElement)(r.Fragment,null,Object(r.createElement)(o.PanelBody,{title:Object(i.__)("Styling","neve"),initialOpen:!1},Object(r.createElement)(o.BaseControl,{id:"nv-cn-background",label:Object(i.__)("Background color:","neve")},Object(r.createElement)(l.ColorPalette,{value:c,onChange:function(e){return n({backgroundColor:e})}}))))},F=function(e){var t=e.getMetaValue,n=e.setMetaValue,c=e.attributes,o=e.setAttributes;return Object(r.createElement)(l.InspectorControls,null,Object(r.createElement)(f,{getMetaValue:t,setMetaValue:n}),Object(r.createElement)(O,{getMetaValue:t,setMetaValue:n}),Object(r.createElement)(B,{getMetaValue:t,setMetaValue:n}),Object(r.createElement)(I,{attributes:c,setAttributes:o}))};Object(g.registerBlockType)("neve-pro-addon/neve-cart-notices",{title:"Cart notice",icon:"admin-comments",category:"design",attributes:{content:{type:"string",source:"html",selector:"p"},backgroundColor:{type:"string",default:"var(--nv-c-1)"}},supports:{multiple:!1},edit:function(e){var t=e.attributes,n=e.setAttributes,c=t.content,o=t.backgroundColor,a=Object(s.useSelect)((function(e){return{meta:e("core/editor").getEditedPostAttribute("meta")||{}}})).meta,u=Object(s.useDispatch)("core/editor").editPost,_=function(e){return a[e]||""},g={backgroundColor:o,color:"var(--nv-text-dark-bg)",padding:"20px"},d=Object(l.useBlockProps)();return Object(r.createElement)(r.Fragment,null,Object(r.createElement)(F,{getMetaValue:_,setMetaValue:function(e,t){u({meta:v()({},e,t)})},attributes:t,setAttributes:n}),Object(r.createElement)("div",{className:"nv-cn-wrapper",style:g},Object(r.createElement)("div",{className:"nv-cn-content"},Object(r.createElement)(b,{getMetaValue:_}),Object(r.createElement)(l.RichText,p()({},d,{className:"nv-cn-content",placeholder:Object(i.__)("Cart notice text","neve"),tagName:"p",onChange:function(e){return n({content:e})},value:c}))),Object(r.createElement)("div",{className:"nv-cn-cta"},Object(r.createElement)(l.InnerBlocks,{allowedBlocks:["core/button"],template:[["core/button",{placeholder:Object(i.__)("Call to action","neve"),align:"right",className:"is-style-primary",formattingControls:[]}]],templateLock:"all"}))))},save:function(e){var t=e.attributes,n=t.backgroundColor,c=t.content,o={backgroundColor:n,padding:"20px"},a=l.useBlockProps.save();return Object(r.createElement)(r.Fragment,null,Object(r.createElement)("div",{className:"nv-cn-wrapper",style:o},Object(r.createElement)("div",{className:"nv-cn-content"},Object(r.createElement)(l.RichText.Content,p()({},a,{tagName:"p",value:c}))),Object(r.createElement)("div",{className:"nv-cn-cta"},Object(r.createElement)(l.InnerBlocks.Content,null))))}})}]);