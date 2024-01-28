import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {
        this.setupModalLinks();
    }

    setupModalLinks() {
        const modalLinks = this.element.querySelectorAll('a[id^="res_info_link_"]');
        modalLinks.forEach((modalLink) => {
            modalLink.addEventListener('click', (event) => this.handleModalLinkClick(event, modalLink));
        });
    }

    handleModalLinkClick(event, modalLink) {
        event.preventDefault();

        const modalLinkId = modalLink.getAttribute('id');
        const resTime = modalLinkId.replace('res_info_link_', '');
        const lastIndex = resTime.lastIndexOf('-');
        const resTimeText = resTime.slice(0, lastIndex) + ' ' + resTime.slice(lastIndex + 1);
        const userName = document.getElementById('user_name_'+resTime).getAttribute('value');
        const userEmail = document.getElementById('user_email_'+resTime).getAttribute('value');
        const userPhone = document.getElementById('user_phone_'+resTime).getAttribute('value');

        // Update modal content
        this.updateModalContent(resTimeText, userName, userEmail, userPhone);

        // Show modal
        this.showModal();
    }

    updateModalContent(resTimeText, userName, userEmail, userPhone) {
        const modalResTime = document.getElementById('modal_res_time');
        const modalUserName = document.getElementById('modal_user_name');
        const modalUserEmail = document.getElementById('modal_user_email');
        const modalUserPhone = document.getElementById('modal_user_phone');

        modalResTime.textContent = resTimeText;
        modalUserName.textContent = userName;
        modalUserEmail.textContent = userEmail;
        modalUserPhone.textContent = userPhone;
    }

    showModal() {
        const modal = document.getElementById('modal-reservation');
        if(modal) {
            const closeBtn = modal.querySelector('.dialog__close');
            modal.showModal(); // Open modal

            closeBtn.addEventListener('click', () => modal.close());
            document.addEventListener('click', (event) => this.handleOutsideClick(event, modal), false);
        } else {
            console.log('Modal doesn\'t exist');
        }
    }

    handleOutsideClick(event, modal) {
        if(event.target.tagName === 'DIALOG') {
            modal.close();
        }
    }
};
