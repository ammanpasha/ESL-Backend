var url_live = "http://www.express-shipping.com/api/api/post";
var url_lcl = "http://localhost:8080/phpRest/api/post";
var url_dev = "http://3.87.219.15/api/api/post";
var url = url_live;


// utility function to parse special characters
function parseSpecialChars(str){
    return str.replace(/&amp;/g, "&").replace(/&lt;/g, "<").replace(/&gt;/g, ">");
 }