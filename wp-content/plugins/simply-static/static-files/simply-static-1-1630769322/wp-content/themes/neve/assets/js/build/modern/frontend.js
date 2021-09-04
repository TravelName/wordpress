!function(){"use strict";var e,t=function(e,t){for(var n=0;n<e.length;n++)t(e[n])},n=e=>{var t=e.split("#");return t.length>1?t[0]:e},r=(e,t,n)=>{for(var r=e instanceof NodeList?e:[e],o=0;o<r.length;o++)r[o]&&r[o].addEventListener(t,n)},o=(e,t)=>{l(e,t,"toggle")},i=(e,t)=>{l(e,t,"add")},a=(e,t)=>{l(e,t,"remove")},l=(e,t,n)=>{for(var r=t.split(" "),o=e instanceof NodeList?e:[e],i=0;i<o.length;i++)o[i]&&o[i].classList[n].apply(o[i].classList,r)},u=null,d=2,s=()=>{var{masonryStatus:e,masonryColumns:t,blogLayout:n}=NeveProperties;"enabled"!==e||t<2||null!==(u=document.querySelector(".nv-index-posts .posts-wrapper"))&&imagesLoaded(u,()=>{window.nvMasonry=new Masonry(u,{itemSelector:"article.layout-".concat(n),columnWidth:"article.layout-".concat(n),percentPosition:!0})})},c=()=>{"enabled"===NeveProperties.infScroll&&null!==document.querySelector(".nv-index-posts .posts-wrapper")&&function(e,t){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:.5,r=new IntersectionObserver(r=>{if(!(r[0].intersectionRatio<=n)){t();var o=setInterval(()=>{var n=e.getBoundingClientRect(),{top:r,left:i,right:a,bottom:l}=n,{innerWidth:u,innerHeight:d}=window;r>=0&&i>=0&&a<=u&&l<=d?t():clearInterval(o)},750)}});r.observe(e)}(document.querySelector(".infinite-scroll-trigger"),()=>{if(parent.wp.customize)return parent.wp.customize.requestChangesetUpdate().then(()=>{v()}),!1;v()})},v=()=>{var e=document.querySelector(".infinite-scroll-trigger");if(null!==e){if(document.querySelector(".nv-loader").style.display="block",d>NeveProperties.maxPages)return e.parentNode.removeChild(e),void(document.querySelector(".nv-loader").style.display="none");var t,n,r,o,i=document.querySelector(".nv-index-posts .posts-wrapper"),a=NeveProperties.lang,l=NeveProperties.endpoint+d,u=m(a?l+"/"+a:l);d++,t=u,n=e=>{if(i.innerHTML+=JSON.parse(e),"enabled"!==NeveProperties.masonryStatus)return!1;window.nvMasonry.reloadItems(),window.nvMasonry.layout()},r=NeveProperties.query,(o=new XMLHttpRequest).onload=()=>{4===o.readyState&&200===o.status&&n(o.response)},o.onerror=()=>{},o.open("POST",t,!0),o.setRequestHeader("Content-Type","application/json; charset=UTF-8"),o.send(r)}},m=e=>void 0===wp.customize?e:(e+="?customize_changeset_uuid="+wp.customize.settings.changeset.uuid+"&customize_autosaved=on","undefined"==typeof _wpCustomizeSettings?e:e+="&customize_preview_nonce="+_wpCustomizeSettings.nonce.preview),p=["dropdown-open","active","nav-clickaway-overlay"],y=()=>{var r;e=window.location.href,g(),function(){var r=document.querySelectorAll(".nv-nav-wrap a");if(0===r.length)return;t(r,t=>{t.addEventListener("click",t=>{var r=t.target.getAttribute("href");if(null===r)return!1;n(r)===n(e)&&window.HFG.toggleMenuSidebar(!1)})})}(),f(),h(),w(),!0===/(Trident|MSIE|Edge)/.test(window.navigator.userAgent)&&(r=document.querySelectorAll('.header--row[data-show-on="desktop"] .sub-menu'),t(r,e=>{var t=e.parentNode;t.addEventListener("mouseenter",()=>{i(e,p[0])}),t.addEventListener("mouseleave",()=>{a(e,p[0])})})),window.HFG.initSearch=function(){h(),f()}},g=()=>{var{isRTL:e}=NeveProperties,n=document.querySelectorAll(".sub-menu, .minimal .nv-nav-search");if(0!==n.length){var r=window.innerWidth;t(n,t=>{var n=t.getBoundingClientRect(),o=n.left;o<0&&(t.style.right=e?"-100%":"auto",t.style.left=e?"auto":0),o+n.width>=r&&(t.style.right=e?0:"100%",t.style.left="auto")}),"undefined"!=typeof menuCalcEvent&&window.dispatchEvent(menuCalcEvent)}};function f(){var e=document.querySelectorAll(".caret-wrap");t(e,e=>{e.addEventListener("click",t=>{t.preventDefault(),t.stopPropagation();var n=e.parentNode.parentNode.querySelector(".sub-menu");o(e,p[0]),o(n,p[0]),S(document.querySelectorAll(".".concat(p[0])),p[0])})})}function h(){var e=document.querySelectorAll(".nv-nav-search"),n=document.querySelectorAll(".menu-item-nav-search"),r=document.querySelectorAll(".close-responsive-search");t(n,e=>{e.addEventListener("click",t=>{t.preventDefault(),t.stopPropagation(),o(e,p[1]),setTimeout(()=>{e.querySelector(".search-field").focus()},50),S(e,p[1])})}),t(e,e=>{e.addEventListener("click",e=>{e.stopPropagation()})}),t(r,e=>{e.addEventListener("click",e=>{e.preventDefault(),t(n,e=>{a(e,p[1])});var r=document.querySelector(".".concat(p[2]));null!==r&&r.parentNode.removeChild(r)})})}function w(){var e=document.querySelector(".header--row .menu-item-nav-cart");if(null!==e){var t=e.querySelector(".nv-nav-cart");null!==t&&(t.style.left=e.getBoundingClientRect().left<350?0:null)}}function S(e,t){var n=document.querySelector(".".concat(p[2]));null!==n&&n.parentNode.removeChild(n),n=document.createElement("div"),i(n,p[2]);var r=document.querySelector("header.header");r.parentNode.insertBefore(n,r),n.addEventListener("click",()=>{a(e,t),n.parentNode.removeChild(n)})}window.addEventListener("resize",w);var b,q=function(){this.options={menuToggleDuration:300},this.init()};function L(){window.HFG=new q,(()=>{if(null===document.querySelector(".blog.nv-index-posts"))return!1;s(),c()})(),y()}function N(){g()}q.prototype.init=function(){var e=arguments.length>0&&void 0!==arguments[0]&&arguments[0];if(!1===e){var t=document.querySelectorAll(".close-sidebar-panel .navbar-toggle");r(t,"click",()=>{this.toggleMenuSidebar(!1)})}var n=document.querySelectorAll(".menu-mobile-toggle");r(n,"click",()=>{this.toggleMenuSidebar(!0)});var o=document.querySelector(".header-menu-sidebar-overlay");r(o,"click",function(){this.toggleMenuSidebar(!1)}.bind(this))},q.prototype.toggleMenuSidebar=function(e){var t=document.querySelectorAll(".menu-mobile-toggle");if(a(document.body,"hiding-header-menu-sidebar"),!NeveProperties.isCustomize&&document.body.classList.contains("is-menu-sidebar")||!1===e){var n=document.querySelector(".nav-clickaway-overlay");null!==n&&n.parentNode.removeChild(n),i(document.body,"hiding-header-menu-sidebar"),a(document.body,"is-menu-sidebar"),a(t,"is-active"),setTimeout(function(){a(document.body,"hiding-header-menu-sidebar")}.bind(this),1e3)}else i(document.body,"is-menu-sidebar"),i(t,"is-active")},window.addEventListener("load",()=>{L()}),window.addEventListener("resize",()=>{clearTimeout(b),b=setTimeout(N,500)})}();