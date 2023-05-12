var ajax = {
	method : 'get',
	url : 'google.com',
	params : {},
	form : null,

	setMethod: function(method){
		this.method = method;
		return this;
	},

	getMethod: function(){
		return this.method;
	},

	setUrl: function(url){
		this.url = url;
		return this;
	},

	getUrl: function(){
		return this.url;
	},

	setParams: function(params){
		this.params = params;
		return this;
	},

	getParams: function(){
		return this.params;
	},

	setForm: function(formId){
		this.form = $("#"+formId);
		this.prepareRequestParams();
		return this;
	},

	getForm: function(){
		return this.form;
	},

	prepareRequestParams: function() {
		this.setUrl(this.getForm().attr("action"));
		this.setMethod(this.getForm().attr("method"));
		this.setParams(this.getForm().serializeArray());
	},

	call: function(){
		$.ajax({
			url:this.getUrl(),
			dataType: "json",
			type:this.getMethod(),
			data:this.getParams()
		}).done(function(response){
			$('#' + response.element).html(response.html);
			if (response.messageBlockHtml !== undefined) {
				$('#message-html').html(response.messageBlockHtml);
			}
		});
	}
};