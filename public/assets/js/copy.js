// KTUtil.onDOMContentLoaded(function () {
//     $('.fragment-config').beautifyJSON({
//         hoverable: false,
//         collapsible: false
//     });
// });


let KTAccountAPIKeys = {
    init: function () {
        KTUtil.each(document.querySelectorAll('img[data-action="copy"]'), (function (e) {
            let data = e;
            new ClipboardJS(e, {
                target: data, text: function () {
                    return data.getAttribute('data-content')
                }
            }).on("success", (function () {
                let c = e.querySelector(".ki-copy"),
                    i = e.querySelector(".ki-check");
               (i = document.createElement("i")).classList.add("ki-solid");
                let toast = document.querySelector('[data-controller="toast"]');
                let toastController = application.getControllerForElementAndIdentifier(toast, 'toast');
                toastController.alert('Config Copied', '', 'info');
                //     i.classList.add("ki-check");
                //     i.classList.add("fs-2");
                //     e.appendChild(i);
                //     data.classList.add("text-success");
                //     data.innerHTML='Copied!';
                //     c.classList.add("d-none");
                //     setTimeout((function () {
                //         c.classList.remove("d-none");
                //             e.removeChild(i)
                //         data.classList.remove("text-success")
                // }), 3000)
            }))
        }))
    }
};
KTUtil.onDOMContentLoaded((function () {
    KTAccountAPIKeys.init()
}));
