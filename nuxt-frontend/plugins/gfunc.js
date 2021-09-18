import swal from 'sweetalert2'


export default ({ app }, inject) => {
    const global = {
        name: 'Global Functions',
        alertSuccess(msg, redirectPath = null, obj = null) {
            swal.fire({
                // position: 'top-end',
                icon: 'success',
                title: msg,
                showConfirmButton: true,
                // timer: 2000
            }).then(function (e) {
                if (e.value && redirectPath && obj) {
                    obj.push(redirectPath)
                }
            });
        },
        alertFailed(msg, redirectPath = null, obj = null) {
            swal.fire({
                icon: 'error',
                title: msg,
                showConfirmButton: true,
                // timer: 2000
            }).then(function (e) {
                if (e.value && redirectPath && obj) {
                    obj.push(redirectPath)
                }
            });
        },
        async alertConfirmation(msgTitle, msgBody, msgType, cancel, btnText, confirmationDone, args) {
            swal.fire({
                title: msgTitle,
                text: msgBody,
                type: msgType,
                showCancelButton: cancel,
                confirmButtonText: btnText,
                allowOutsideClick: false
            }).then(function (e) {
                if (e.value) {
                    confirmationDone(args)
                }
            })

        },
        decodeHtml(html = '') {
            if(process.client) {
                let txt = document.createElement("textarea");
                txt.innerHTML = html;
                return txt.value;
            }

        },
        truncate(string, n) {
            if (string.length > n) {
                return string.substring(0, n) + '...';
            }
            return string;
        },
        printText(string, charactersCount = 40){
            return this.truncate(this.decodeHtml(string), charactersCount);
        }
    }

    inject('global', global)
}
