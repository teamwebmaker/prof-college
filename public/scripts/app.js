const swiperSlider = {
    slidesPerView: 1,
    speed: 1000,
    effect: "fade",
    autoplay: {
        delay: 3000,
    },
    spaceBetween: 30,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    }
}

const swiperPartner = {
    slidesPerView: 2,
    speed: 1000,
    autoplay: {
        delay: 3000,
    },
    spaceBetween: 30,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        700: {
            slidesPerView: 2
        },
        900: {
            slidesPerView: 3
        },
        1200: {
            slidesPerView: 4
        },
    }
}

const pageModal = new bootstrap.Modal('#pageModal', {
    keyboard: false
})

function showModal(templateId){
    /**
     *
     * @type {HTMLElement}
     */
    const clone = document.getElementById(templateId).content.cloneNode(true);
    const modalBody = pageModal._element.querySelector('.modal-body')
    modalBody.innerHTML = ''
    modalBody.append(clone)

    pageModal.show()
}

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))


