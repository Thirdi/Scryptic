var ajaxUploaderQueue = 0;

function myAjaxUploader() {
	iframes = document.getElementsByTagName("iframe");
	ajaxUploaderQueue = 0;
	if(iframes.length > 0) {
		for(i=0; i<iframes.length; i++) {
			if(iframes[i].name == "ajaxUploader") {
				form = iframes[i].contentWindow.document.getElementById("iform");
				form.submit();
				ajaxUploaderQueue++;
			}
		} 
	}
}

Ajax.Updater = Class.create();

Object.extend(Object.extend(Ajax.Updater.prototype, Ajax.Request.prototype), {
  initialize: function(container, url, options) {
    this.container = {
      success: (container.success || container),
      failure: (container.failure || (container.success ? null : container))
    }

    this.transport = Ajax.getTransport();
    this.setOptions(options);

    var onComplete = this.options.onComplete || Prototype.emptyFunction;
    this.options.onComplete = (function(transport, param) {
      this.updateContent();
      onComplete(transport, param);
    }).bind(this);

	this.url = url;
    this.preRequest();
  },

  preRequest: function() {
  	if(ajaxUploaderQueue > 0) {
  		setTimeout(this.preRequest.bind(this), 10);
  	} else {
  		this.request(this.url);
  	}
  },
  
  updateContent: function() {
    var receiver = this.container[this.success() ? 'success' : 'failure'];
    var response = this.transport.responseText;

    if (!this.options.evalScripts) response = response.stripScripts();

    if (receiver = $(receiver)) {
      if (this.options.insertion)
        new this.options.insertion(receiver, response);
      else
        receiver.update(response);
    }

    if (this.success()) {
      if (this.onComplete)
        setTimeout(this.onComplete.bind(this), 10);
    }
  }
});

