// Get all links that start with #modal
const modalLinks = document.querySelectorAll('a[id^="res_info_link_"]');

modalLinks.forEach(function (modalLink, index) {
  // User data
  const modalLinkId = modalLink.getAttribute('id');
  const resTime = modalLinkId.replace('res_info_link_', '');
  const lastIndex = resTime.lastIndexOf('-');
  let resTimeText = resTime.slice(0, lastIndex)
      + ' '
      + resTime.slice(lastIndex + 1);
  let userName = document.getElementById('user_name_'+resTime).getAttribute('value');
  let userEmail = document.getElementById('user_email_'+resTime).getAttribute('value');
  let userPhone = document.getElementById('user_phone_'+resTime).getAttribute('value');
  
  // Modal
  // Get modal ID to match the modal
  const modalId = 'modal-reservation';
  let modalResTime = document.getElementById('modal_res_time');
  let modalUserName = document.getElementById('modal_user_name');
  let modalUserEmail = document.getElementById('modal_user_email');
  let modalUserPhone = document.getElementById('modal_user_phone');
  
  // Click on link
  modalLink.addEventListener('click', function (event) {
    modalResTime.textContent = resTimeText;
    modalUserName.textContent = userName;
    modalUserEmail.textContent = userEmail;
    modalUserPhone.textContent = userPhone;
    
    // Get modal element
    const modal = document.getElementById(modalId);
    // If modal with an ID exists
    if(modal){
      // Get close button
      const closeBtn = modal.querySelector('.dialog__close');
      event.preventDefault();
      modal.showModal(); // Open modal
      
      // Close modal on click
      closeBtn.addEventListener('click', function (event) {
        modal.close();
      });
      
      // Close modal when clicking outside modal
      document.addEventListener('click', function (event) {
        
        const dialogEl = event.target.tagName;
        const dialogElId = event.target.getAttribute('id');
        if(dialogEl == 'DIALOG'){
          // Close modal
          modal.close();
        }
      }, false);
      
    // If modal ID not exists
    } else {
      console.log('Modal doesn\'t exist');
    }
  });
});