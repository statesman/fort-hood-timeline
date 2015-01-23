this["JST"] = this["JST"] || {};

this["JST"]["controls"] = Handlebars.template({"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  return "<div class=\"controls\">\r\n  <div class=\"expand-collapse-buttons\">\r\n    <a class=\"expand-all active\" href=\"#\"><span>EXPAND ALL <i class=\"fa fa-caret-down\"></i><i class=\"fa fa-caret-up\"></i></span></a>\r\n    <a class=\"collapse-all\" href=\"#\"><span>COLLAPSE ALL <i class=\"fa fa-caret-down\"></i><i class=\"fa fa-caret-up\"></i></span></a>\r\n  </div>\r\n  <div class=\"sort-buttons\">\r\n    <a class=\"sort-newest active\" href=\"#\"><span>NEWEST FIRST <i class=\"fa fa-caret-down\"></i><i class=\"fa fa-caret-up\"></i></span></a>\r\n    <a class=\"sort-oldest\" href=\"#\"><span>OLDEST FIRST <i class=\"fa fa-caret-down\"></i><i class=\"fa fa-caret-up\"></i></span></a>\r\n  </div>\r\n</div>\r\n";
  },"useData":true});



this["JST"]["group"] = Handlebars.template({"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "<div class=\"item group-marker\">\r\n  <div class=\"marker\">"
    + escapeExpression(((helper = (helper = helpers.name || (depth0 != null ? depth0.name : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"name","hash":{},"data":data}) : helper)))
    + "</div>\r\n</div>\r\n";
},"useData":true});



this["JST"]["post"] = Handlebars.template({"1":function(depth0,helpers,partials,data) {
  var stack1, helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "        <img class=\"img-responsive\" src=\""
    + escapeExpression(((helper = (helper = helpers.photo_url || (depth0 != null ? depth0.photo_url : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"photo_url","hash":{},"data":data}) : helper)))
    + "\" alt=\"\">\r\n";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.caption : depth0), {"name":"if","hash":{},"fn":this.program(2, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + "        <hr />\r\n";
},"2":function(depth0,helpers,partials,data) {
  var stack1, helper, functionType="function", helperMissing=helpers.helperMissing, buffer = "          <div class=\"caption\">";
  stack1 = ((helper = (helper = helpers.caption || (depth0 != null ? depth0.caption : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"caption","hash":{},"data":data}) : helper));
  if (stack1 != null) { buffer += stack1; }
  return buffer + "</div>\r\n";
},"4":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "        <div class=\"text\">"
    + escapeExpression(((helper = (helper = helpers.body || (depth0 != null ? depth0.body : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"body","hash":{},"data":data}) : helper)))
    + "</div>\r\n";
},"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  var stack1, helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "<div class=\"item post clearfix\">\r\n  <div class=\"inner\">\r\n    <div class=\"title\">\r\n      <h3>"
    + escapeExpression(((helper = (helper = helpers.title || (depth0 != null ? depth0.title : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"title","hash":{},"data":data}) : helper)))
    + "</h3>\r\n    </div>\r\n    <div class=\"date\">\r\n      <div class=\"shadow-cover\"></div>"
    + escapeExpression(((helper = (helper = helpers.display_date || (depth0 != null ? depth0.display_date : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"display_date","hash":{},"data":data}) : helper)))
    + "\r\n    </div>\r\n    <div class=\"body\">\r\n";
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.photo_url : depth0), {"name":"if","hash":{},"fn":this.program(1, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  stack1 = helpers['if'].call(depth0, (depth0 != null ? depth0.body : depth0), {"name":"if","hash":{},"fn":this.program(4, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + "    </div>\r\n  </div>\r\n</div>\r\n";
},"useData":true});