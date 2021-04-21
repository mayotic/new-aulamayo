/* Generic functions */

/* Extends jQuery */
String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

/* Mini template system */
function tmpl (data, template, wrapper = '{{content}}') {
	let output = '', row = '';
	for (var i in data) {
		let keys = Object.keys(data[i]), row = template;
		for (k in keys) {
			row = row.replaceAll('{{' + keys[k] + '}}', data[i][keys[k]]);
		}
		output += row;
	}
	return wrapper.replace('{{content}}', output);
}

/* Front helpers */
function addPartialSpinner(node) {
	$(node).addClass('loading-spinner').find('.courtain').addClass('overlay');
}
function removePartialSpinner(node) {
	$(node).removeClass('loading-spinner').find('.courtain').removeClass('overlay');
}

/* Front tools */
function exportHTMLtoWORD(data){
	var title = (typeof data.title !== 'undefined') ? data.title : '';
	var content = (typeof data.content !== 'undefined') ? data.content : '';
	 var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
				"xmlns:w='urn:schemas-microsoft-com:office:word' "+
				"xmlns='http://www.w3.org/TR/REC-html40'>"+
				"<head><meta charset='utf-8'><title>" + title + "</title></head><body>";
	 var footer = "</body></html>";
	 // var sourceHTML = header+document.getElementById("source-html").innerHTML+footer;
	 var sourceHTML = header + content + footer;

	 var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
	 var fileDownload = document.createElement("a");
	 document.body.appendChild(fileDownload);
	 fileDownload.href = source;
	 fileDownload.download = 'document.doc';
	 console.log(fileDownload); // Debug
	 fileDownload.click();
	 document.body.removeChild(fileDownload);
}
