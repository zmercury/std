document.addEventListener('DOMContentLoaded', function () {
  const accordionHeaders = document.querySelectorAll('.accordion-header');
  
  accordionHeaders.forEach(header => {
    header.addEventListener('click', () => {
      const accordionItem = header.parentElement;
      const accordionContent = accordionItem.querySelector('.accordion-content');
      
      accordionContent.classList.toggle('active');
      
      if (accordionContent.classList.contains('active')) {
        accordionContent.style.display = 'block';
      } else {
        accordionContent.style.display = 'none';
      }
      
      const accordionIconUp = accordionItem.querySelector('.accordion-icon-up');
      const accordionIconDown = accordionItem.querySelector('.accordion-icon-down');
      
      if(accordionIconUp.classList.contains('hidden')) {
        accordionIconUp.classList.remove('hidden');
        accordionIconDown.classList.add('hidden');
      } else {
        accordionIconDown.classList.remove('hidden');
        accordionIconUp.classList.add('hidden');
      }
    });
  });
});
