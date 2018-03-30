
/* ========================================================================
 * bootstrap-spin - v1.0
 * https://github.com/wpic/bootstrap-spin
 * ========================================================================
 * Copyright 2014 WPIC, Hamed Abdollahpour
 *
 * ========================================================================
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================================
 */
!function(t){t.fn.bootstrapNumber=function(n){var e=t.extend({upClass:"default",downClass:"default",center:!0},n);return this.each(function(){function n(t){return p&&p>t||r&&t>r?!1:(o.val(t),!0)}var a=t(this),o=a.clone(),p=a.attr("min"),r=a.attr("max"),s=t("<div class='input-group'></div>"),u=t("<button type='button'>-</button>").attr("class","btn btn-"+e.downClass).click(function(){n(parseInt(o.val())-1)}),c=t("<button type='button'>+</button>").attr("class","btn btn-"+e.upClass).click(function(){n(parseInt(o.val())+1)});t("<span class='input-group-btn'></span>").append(u).appendTo(s),o.appendTo(s),o&&o.css("text-align","center"),t("<span class='input-group-btn'></span>").append(c).appendTo(s),o.attr("type","text").keydown(function(n){if(!(-1!==t.inArray(n.keyCode,[46,8,9,27,13,110,190])||65==n.keyCode&&n.ctrlKey===!0||n.keyCode>=35&&n.keyCode<=39)){(n.shiftKey||n.keyCode<48||n.keyCode>57)&&(n.keyCode<96||n.keyCode>105)&&n.preventDefault();var e=String.fromCharCode(n.which),a=parseInt(o.val()+e);(p&&p>a||r&&a>r)&&n.preventDefault()}}),a.replaceWith(s)})}}(jQuery);