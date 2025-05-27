class clsAjax {

    constructor(url, app) {
        this.xhttp = new XMLHttpRequest();
        this.event = new Event('clsAjax-onLoad');
        this.app = app;
        this.url = url;
        this.response = null;
        this.responseXML = null;
        this.callback = null;

        this.xhttp.addEventListener("load", this._onLoad.bind(this), false); 
        this.xhttp.addEventListener("error", this._onError.bind(this), false);
    }

    /////////////////////////////////////////////////////////////////

    Call(callback = null) {
        this.callback = callback;
        this.xhttp.open('GET', this.url, true);
        this.xhttp.send(null);
    }

    /////////////////////////////////////////////////////////////////

    _onLoad() {
        if (this.xhttp.readyState === this.xhttp.DONE) {
            if (this.xhttp.status === 200) {
                this.response = this.xhttp.responseText;
                this.responseXML = this.xhttp.responseXML;

                // Si hay una función callback definida, la llama
                if (this.callback && typeof this.callback === 'function') {
                    this.callback(this.response);
                }

                // También lanza un evento personalizado, si lo estás escuchando
                this._dispatchEvent();
            } else {
                console.error("Error in the server response: ", this.xhttp.status);
            }
        }
    }

    /////////////////////////////////////////////////////////////////

    _dispatchEvent() {
        const new_event = new CustomEvent("__CALL_RETURNED__", {
            detail: {
                response: this.response
            }
        });
        document.dispatchEvent(new_event);
    }

    /////////////////////////////////////////////////////////////////

    _onError() {
        console.log("Error loading the document.");
    }
}