// Keep track of previous width for calculations
let width = window.innerWidth;

// Handle navbar being collapsed or not when screen is resized
$(window).resize(() => {
  const navbar = $('nav');
  const navbarItems = $('.navbar-items');

  if (width >= 640) {
    if (window.innerWidth > 640) {
      navbarItems.css({ display: 'initial', height: 'initial' });
      navbar.attr('collapsed', 'true');
    } else {
      navbarItems.css({ display: 'none', height: '0px' });
    }
  }

  width = innerWidth;
});

// Handle navbar being collapsed or not when toggle button is clicked
$('#navbar-toggle').click(() => {
  const navbar = $('nav');
  const navbarItems = $('.navbar-items');
  const collapsed = navbar.attr('collapsed');
  navbar.attr('collapsed', `${collapsed === 'true' ? 'false' : 'true'}`);
  
  if (collapsed === 'true') {
    navbarItems.css({ display: 'initial', height: 'initial' });
  } else {
    navbarItems.css({ display: 'none', height: '0px' });
  }
});