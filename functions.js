function getJsonData(){
    var jqXHR = $.ajax({
        url: "products.json",
        async: false});
    return $.parseJSON(jqXHR.responseText);
}
export const getJson = getJsonData()
