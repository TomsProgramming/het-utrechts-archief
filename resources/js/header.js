document.addEventListener('DOMContentLoaded', function(){
    const bodyElement = document.querySelector('body');
    const navElement = bodyElement.querySelector('header nav')
    const navItems = navElement.querySelectorAll('.nav-item');
    const navItemsArray = Array.from(navItems);

    bodyElement.addEventListener('click', function(e){
        console.log('click');
        const targetElement = e.target;
        let navItemElement;

        let checks = 0;
        let newCheck = targetElement;
        while(checks <= 1 && !navItemElement){
            if(newCheck?.classList?.contains('nav-item')){
                navItemElement = newCheck;
                break;
            }

            newCheck = newCheck?.parentElement;
            checks += 1;
        }

        const openNavItems = navElement.querySelectorAll('.nav-item.open');
        for (let i = 0; i < openNavItems.length; i++) {
            const openNavItemElement = openNavItems[i];
            
            if(openNavItemElement != navItemElement){
                openNavItemElement.classList.remove('open');
            }
        }

        console.log(navItemsArray);
        console.log(navItemElement);
        if (!navItemElement || (navItemsArray && !navItemsArray.includes(navItemElement))) return;
        navItemElement.classList.toggle('open');

    });
});