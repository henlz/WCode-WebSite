/**
 * material.js
 *
 * @package material-design-par-amauri
 */
var material_design_par_amauri_par_amauri = {

    "lastScrollTop": 0,
    "st": 0,
    "isToolbarVisible": true,
    "isMenuOpen": false,
    "primary_color": '',
    
    "positionning": function () {
    	"use strict";
        jQuery('#primary').css('margin-top', jQuery('#masthead').height() - 100 + 'px');
        
        if (jQuery('#positionning').css('display') === 'block') {
            jQuery('#loveit').css('bottom', ((((jQuery(window).height()) - (jQuery('body').height() + 100)) / 2) + 70) + 'px');
        } else {
            jQuery('#loveit').css('bottom', '30px');
            if (jQuery('#masthead').height() == 200) {
                jQuery('#masthead').css('background', 'transparent');
                jQuery('#primary').css('margin-top', (jQuery('#toolbar').height() + 40) + 'px');
                jQuery('#toolbar').css('background', material_design_par_amauri_par_amauri.primary_color);
                jQuery('#subtitle').css('display', 'inline-block');
            }
        }
		
		var ic_menu_offset = jQuery('article,.page-content').offset();
		jQuery('#menu').css('left', (ic_menu_offset['left'] + jQuery('article,.page-content').width() + 30 - jQuery('#menu').width()) + 'px');
		jQuery('#loveit').css('left', (ic_menu_offset['left'] + jQuery('article,.page-content').width() + 30 - (jQuery('#loveit').width() / 2)) + 'px');

		var entry_meta = 0;
		if (jQuery('.entry-meta').height() > 0) {
			entry_meta = jQuery('.entry-meta').height() - 10;
		}
        jQuery('body.single h1.entry-title').css('margin-top', '-' + ((jQuery('body.single h1.entry-title').height() + jQuery('header.entry-header').height() + 80 + entry_meta)) + 'px');
        jQuery('body.page h1.entry-title').css('margin-top', '-' + ((jQuery('body.page h1.entry-title').height() + 80)) + 'px');
        jQuery('h1.page-title').css('margin-top', '-' + ((jQuery('h1.page-title').height() + 38)) + 'px');
    
        jQuery('h1.page-title, h1.entry-title').css('visibility', 'visible');
		jQuery('#toolbar form').css('display', jQuery('#subtitle').css('display'));
		
		// trick for fixed element and adminbar
		jQuery('#toolbar').css('top', (0 + jQuery('#wpadminbar').height()) + 'px');
		jQuery('#menu').css('top', (20 + jQuery('#wpadminbar').height()) + 'px');
		jQuery('#drawer').css('top', (0 + jQuery('#wpadminbar').height()) + 'px');
    },
    
    "start": function () {
    	"use strict";
		material_design_par_amauri_par_amauri.primary_color = jQuery('#positionning').css('backgroundColor')
        material_design_par_amauri_par_amauri.positionning();
		
		jQuery('#toolbar input.search-field').val(jQuery('#toolbar input.search-field').attr('placeholder'));
		jQuery('#toolbar input.search-field').bind('focus', function() {
			if (this.value == jQuery(this).attr('placeholder')) {
				this.value = '';
			}
		});
		jQuery('#toolbar input.search-field').bind('blur', function() {
			if (this.value == '') {
				this.value = jQuery(this).attr('placeholder');
			}
		});
    
        jQuery(window).bind('resize', function(e) {
            material_design_par_amauri_par_amauri.positionning();
        });
    
        jQuery(window).bind('click', function(e) {
            if (material_design_par_amauri_par_amauri.isMenuOpen) {
                material_design_par_amauri_par_amauri.isMenuOpen = false;
                jQuery('#menu').css('display', 'none');
            }
        });
    
        jQuery('#ic_menu').bind('click', function(e) {
            jQuery('#menu').css('display', 'block');
            setTimeout(function() {
                material_design_par_amauri_par_amauri.isMenuOpen = true;
            }, 100);
        });
        
        jQuery('#ic_drawer').bind('click', function(e) {
            jQuery("#drawer").css('display', 'block');
            jQuery('#background').css('display', 'block');
        });
        
        jQuery('#loveit').bind('click', function(e) {
            if (jQuery('#shareit').css('display') !== 'none') {
                jQuery('#shareit').css('display', 'none');
                jQuery('#background').css('display', 'none');
            } else {
                jQuery('#shareit').css('display', 'block');
                jQuery('#background').css('display', 'block');
            }
        });
        
        jQuery('#background').bind('click', function(e) {
            jQuery("#drawer").css('display', 'none');
            jQuery('#shareit').css('display', 'none');
            jQuery('#background').css('display', 'none');
        });
        
        jQuery(window).bind('scroll', function(e) {
            material_design_par_amauri_par_amauri.st = jQuery(this).scrollTop();
            jQuery('#masthead').css('top', (material_design_par_amauri_par_amauri.st * 0.3));
            if (material_design_par_amauri_par_amauri.isToolbarVisible) {
                if (jQuery('#toolbar').css('display') !== 'block') {
                    jQuery('#toolbar').css('display', 'block');
                }
                if (jQuery('#loveit').css('display') !== 'block') {
                    jQuery('#loveit').css('display', 'block');
                }
            } else {
                if (jQuery('#toolbar').css('display') !== 'none') {
                    jQuery('#toolbar').css('display', 'none');
                }
                if (jQuery('#loveit').css('display') !== 'none') {
                    jQuery('#loveit').css('display', 'none');
                }
            }
    
            if (jQuery(window).scrollTop() >= ((jQuery('#masthead').height() - (200 + jQuery('#wpadminbar').height())) - jQuery('h1.page-title,h1.entry-title').height())) {
                if ((material_design_par_amauri_par_amauri.st - material_design_par_amauri_par_amauri.lastScrollTop) > 1 || (material_design_par_amauri_par_amauri.st - material_design_par_amauri_par_amauri.lastScrollTop) < -1) {
                    if (material_design_par_amauri_par_amauri.st > material_design_par_amauri_par_amauri.lastScrollTop) {
                        if (material_design_par_amauri_par_amauri.isToolbarVisible) {
                            material_design_par_amauri_par_amauri.isToolbarVisible = false;
                        }
                    } else {
                        if (!material_design_par_amauri_par_amauri.isToolbarVisible) {
                            jQuery("#toolbar").css('background', material_design_par_amauri_par_amauri.primary_color);
                            jQuery("#subtitle").css('display', 'inline-block');
                            material_design_par_amauri_par_amauri.isToolbarVisible = true;
                        }
                    }
                }
            } else {
                jQuery("#toolbar").css('background', 'transparent');
                jQuery("#subtitle").css('display', 'none');
                if (!material_design_par_amauri_par_amauri.isToolbarVisible) {
                    jQuery("#toolbar").css('background', material_design_par_amauri_par_amauri.primary_color);
                    jQuery("#subtitle").css('display', 'inline-block');
                    material_design_par_amauri_par_amauri.isToolbarVisible = true;
                }
            }
			
			jQuery('#toolbar form').css('display', jQuery('#subtitle').css('display'));
            material_design_par_amauri_par_amauri.lastScrollTop = material_design_par_amauri_par_amauri.st;
        });
    
        if (document.getElementById('back') !== null) {
            document.getElementById('back').style.display = 'none';
        }
    
		jQuery('#loveit').css('display', 'block');
    }
};

jQuery(window).load(material_design_par_amauri_par_amauri.start);

