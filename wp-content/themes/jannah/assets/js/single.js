/*! Bootstrap tolltips v3.4.0. (c) 2011-2019 Twitter. MIT @license: en.wikipedia.org/wiki/MIT_License renamed from .tooltip to tietooltip to avoid conflict with jQuery UI Tooltip */
if("undefined"==typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");!function(t){"use strict";var e=t.fn.jquery.split(" ")[0].split(".");if(e[0]<2&&e[1]<9||1==e[0]&&9==e[1]&&e[2]<1||e[0]>3)throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 4")}(jQuery),function(t){"use strict";var e=function(t,e){this.type=null,this.options=null,this.enabled=null,this.timeout=null,this.hoverState=null,this.$element=null,this.inState=null,this.init("tooltip",t,e)};e.VERSION="3.4.0",e.TRANSITION_DURATION=150,e.DEFAULTS={animation:!0,placement:"top",selector:!1,template:'<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,container:!1,viewport:{selector:"body",padding:0}},e.prototype.init=function(e,i,o){if(this.enabled=!0,this.type=e,this.$element=t(i),this.options=this.getOptions(o),this.$viewport=this.options.viewport&&t(document).find(t.isFunction(this.options.viewport)?this.options.viewport.call(this,this.$element):this.options.viewport.selector||this.options.viewport),this.inState={click:!1,hover:!1,focus:!1},this.$element[0]instanceof document.constructor&&!this.options.selector)throw new Error("`selector` option must be specified when initializing "+this.type+" on the window.document object!");for(var n=this.options.trigger.split(" "),s=n.length;s--;){var r=n[s];if("click"==r)this.$element.on("click."+this.type,this.options.selector,t.proxy(this.toggle,this));else if("manual"!=r){var l="hover"==r?"mouseenter":"focusin",a="hover"==r?"mouseleave":"focusout";this.$element.on(l+"."+this.type,this.options.selector,t.proxy(this.enter,this)),this.$element.on(a+"."+this.type,this.options.selector,t.proxy(this.leave,this))}}this.options.selector?this._options=t.extend({},this.options,{trigger:"manual",selector:""}):this.fixTitle()},e.prototype.getDefaults=function(){return e.DEFAULTS},e.prototype.getOptions=function(e){return(e=t.extend({},this.getDefaults(),this.$element.data(),e)).delay&&"number"==typeof e.delay&&(e.delay={show:e.delay,hide:e.delay}),e},e.prototype.getDelegateOptions=function(){var e={},i=this.getDefaults();return this._options&&t.each(this._options,function(t,o){i[t]!=o&&(e[t]=o)}),e},e.prototype.enter=function(e){var i=e instanceof this.constructor?e:t(e.currentTarget).data("bs."+this.type);if(i||(i=new this.constructor(e.currentTarget,this.getDelegateOptions()),t(e.currentTarget).data("bs."+this.type,i)),e instanceof t.Event&&(i.inState["focusin"==e.type?"focus":"hover"]=!0),i.tip().hasClass("in")||"in"==i.hoverState)i.hoverState="in";else{if(clearTimeout(i.timeout),i.hoverState="in",!i.options.delay||!i.options.delay.show)return i.show();i.timeout=setTimeout(function(){"in"==i.hoverState&&i.show()},i.options.delay.show)}},e.prototype.isInStateTrue=function(){for(var t in this.inState)if(this.inState[t])return!0;return!1},e.prototype.leave=function(e){var i=e instanceof this.constructor?e:t(e.currentTarget).data("bs."+this.type);if(i||(i=new this.constructor(e.currentTarget,this.getDelegateOptions()),t(e.currentTarget).data("bs."+this.type,i)),e instanceof t.Event&&(i.inState["focusout"==e.type?"focus":"hover"]=!1),!i.isInStateTrue()){if(clearTimeout(i.timeout),i.hoverState="out",!i.options.delay||!i.options.delay.hide)return i.hide();i.timeout=setTimeout(function(){"out"==i.hoverState&&i.hide()},i.options.delay.hide)}},e.prototype.show=function(){var i=t.Event("show.bs."+this.type);if(this.hasContent()&&this.enabled){this.$element.trigger(i);var o=t.contains(this.$element[0].ownerDocument.documentElement,this.$element[0]);if(i.isDefaultPrevented()||!o)return;var n=this,s=this.tip(),r=this.getUID(this.type);this.setContent(),s.attr("id",r),this.$element.attr("aria-describedby",r),this.options.animation&&s.addClass("fade");var l="function"==typeof this.options.placement?this.options.placement.call(this,s[0],this.$element[0]):this.options.placement,a=/\s?auto?\s?/i,p=a.test(l);p&&(l=l.replace(a,"")||"top"),s.detach().css({top:0,left:0,display:"block"}).addClass(l).data("bs."+this.type,this),this.options.container?s.appendTo(t(document).find(this.options.container)):s.insertAfter(this.$element),this.$element.trigger("inserted.bs."+this.type);var h=this.getPosition(),f=s[0].offsetWidth,u=s[0].offsetHeight;if(p){var c=l,d=this.getPosition(this.$viewport);l="bottom"==l&&h.bottom+u>d.bottom?"top":"top"==l&&h.top-u<d.top?"bottom":"right"==l&&h.right+f>d.width?"left":"left"==l&&h.left-f<d.left?"right":l,s.removeClass(c).addClass(l)}var g=this.getCalculatedOffset(l,h,f,u);this.applyPlacement(g,l);var v=function(){var t=n.hoverState;n.$element.trigger("shown.bs."+n.type),n.hoverState=null,"out"==t&&n.leave(n)};t.support.transition&&this.$tip.hasClass("fade")?s.one("bsTransitionEnd",v).emulateTransitionEnd(e.TRANSITION_DURATION):v()}},e.prototype.applyPlacement=function(e,i){var o=this.tip(),n=o[0].offsetWidth,s=o[0].offsetHeight,r=parseInt(o.css("margin-top"),10),l=parseInt(o.css("margin-left"),10);isNaN(r)&&(r=0),isNaN(l)&&(l=0),e.top+=r,e.left+=l,t.offset.setOffset(o[0],t.extend({using:function(t){o.css({top:Math.round(t.top),left:Math.round(t.left)})}},e),0),o.addClass("in");var a=o[0].offsetWidth,p=o[0].offsetHeight;"top"==i&&p!=s&&(e.top=e.top+s-p);var h=this.getViewportAdjustedDelta(i,e,a,p);h.left?e.left+=h.left:e.top+=h.top;var f=/top|bottom/.test(i),u=f?2*h.left-n+a:2*h.top-s+p,c=f?"offsetWidth":"offsetHeight";o.offset(e),this.replaceArrow(u,o[0][c],f)},e.prototype.replaceArrow=function(t,e,i){this.arrow().css(i?"left":"top",50*(1-t/e)+"%").css(i?"top":"left","")},e.prototype.setContent=function(){var t=this.tip(),e=this.getTitle();t.find(".tooltip-inner")[this.options.html?"html":"text"](e),t.removeClass("fade in top bottom left right")},e.prototype.hide=function(i){var o=this,n=t(this.$tip),s=t.Event("hide.bs."+this.type);function r(){"in"!=o.hoverState&&n.detach(),o.$element&&o.$element.removeAttr("aria-describedby").trigger("hidden.bs."+o.type),i&&i()}if(this.$element.trigger(s),!s.isDefaultPrevented())return n.removeClass("in"),t.support.transition&&n.hasClass("fade")?n.one("bsTransitionEnd",r).emulateTransitionEnd(e.TRANSITION_DURATION):r(),this.hoverState=null,this},e.prototype.fixTitle=function(){var t=this.$element;(t.attr("title")||"string"!=typeof t.attr("data-original-title"))&&t.attr("data-original-title",t.attr("title")||"").attr("title","")},e.prototype.hasContent=function(){return this.getTitle()},e.prototype.getPosition=function(e){var i=(e=e||this.$element)[0],o="BODY"==i.tagName,n=i.getBoundingClientRect();null==n.width&&(n=t.extend({},n,{width:n.right-n.left,height:n.bottom-n.top}));var s=window.SVGElement&&i instanceof window.SVGElement,r=o?{top:0,left:0}:s?null:e.offset(),l={scroll:o?document.documentElement.scrollTop||document.body.scrollTop:e.scrollTop()},a=o?{width:t(window).width(),height:t(window).height()}:null;return t.extend({},n,l,a,r)},e.prototype.getCalculatedOffset=function(t,e,i,o){return"bottom"==t?{top:e.top+e.height,left:e.left+e.width/2-i/2}:"top"==t?{top:e.top-o,left:e.left+e.width/2-i/2}:"left"==t?{top:e.top+e.height/2-o/2,left:e.left-i}:{top:e.top+e.height/2-o/2,left:e.left+e.width}},e.prototype.getViewportAdjustedDelta=function(t,e,i,o){var n={top:0,left:0};if(!this.$viewport)return n;var s=this.options.viewport&&this.options.viewport.padding||0,r=this.getPosition(this.$viewport);if(/right|left/.test(t)){var l=e.top-s-r.scroll,a=e.top+s-r.scroll+o;l<r.top?n.top=r.top-l:a>r.top+r.height&&(n.top=r.top+r.height-a)}else{var p=e.left-s,h=e.left+s+i;p<r.left?n.left=r.left-p:h>r.right&&(n.left=r.left+r.width-h)}return n},e.prototype.getTitle=function(){var t=this.$element,e=this.options;return t.attr("data-original-title")||("function"==typeof e.title?e.title.call(t[0]):e.title)},e.prototype.getUID=function(t){do{t+=~~(1e6*Math.random())}while(document.getElementById(t));return t},e.prototype.tip=function(){if(!this.$tip&&(this.$tip=t(this.options.template),1!=this.$tip.length))throw new Error(this.type+" `template` option must consist of exactly 1 top-level element!");return this.$tip},e.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".tooltip-arrow")},e.prototype.enable=function(){this.enabled=!0},e.prototype.disable=function(){this.enabled=!1},e.prototype.toggleEnabled=function(){this.enabled=!this.enabled},e.prototype.toggle=function(e){var i=this;e&&((i=t(e.currentTarget).data("bs."+this.type))||(i=new this.constructor(e.currentTarget,this.getDelegateOptions()),t(e.currentTarget).data("bs."+this.type,i))),e?(i.inState.click=!i.inState.click,i.isInStateTrue()?i.enter(i):i.leave(i)):i.tip().hasClass("in")?i.leave(i):i.enter(i)},e.prototype.destroy=function(){var t=this;clearTimeout(this.timeout),this.hide(function(){t.$element.off("."+t.type).removeData("bs."+t.type),t.$tip&&t.$tip.detach(),t.$tip=null,t.$arrow=null,t.$viewport=null,t.$element=null})};var i=t.fn.tietooltip;t.fn.tietooltip=function(i){return this.each(function(){var o=t(this),n=o.data("bs.tooltip"),s="object"==typeof i&&i;!n&&/destroy|hide/.test(i)||(n||o.data("bs.tooltip",n=new e(this,s)),"string"==typeof i&&n[i]())})},t.fn.tietooltip.Constructor=e,t.fn.tietooltip.noConflict=function(){return t.fn.tooltip=i,this}}(jQuery);

/**
 * Declaring and initializing global variables
 */
var $the_post    = jQuery('#the-post'),
		$postContent = $the_post.find('.entry');


$doc.ready(function(){

	'use strict';


	/**
	 * Toggle post content for mobile
	 */
	$doc.on('click', '#toggle-post-button', function(){
		$postContent.toggleClass('is-expanded');
		jQuery(this).hide();
		return false;
	});


	/**
	 * Share Buttons : Print
	 */
	$doc.on('click', '.print-share-btn', function(){
		window.print();
		return false;
	});


	/**
	 * Responsive Tables
	 */
	if( tie.responsive_tables ){
		$the_post.find('table').wrap( '<div class="table-is-responsive"></div>' );
	}


	/**
	 * Tooltips
	 */
	jQuery('[data-toggle="tooltip"]').tietooltip(); // Measure 1ms


	/**
	 * Open Share buttons in a popup
	 */
	$doc.on('click', '.share-links a:not(.email-share-btn)', function(){
		var link = jQuery(this).attr('href');
		if( link != '#' ){
			window.open( link, 'TIEshare', 'height=450,width=760,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0' );
			return false;
		}
	});


	/**
	 * Sticky video
	 */
	if( tie.is_sticky_video && jQuery( '#the-sticky-video' ).length ){

		var $featuredMedia = jQuery( '#the-sticky-video' ),
				top = $featuredMedia.offset().top,
				beforeOffset = tie.sticky_desktop ? 60 : 0,
				beforeOffset = $body.hasClass('admin-bar') ? beforeOffset + 32 : beforeOffset,
				offset = Math.floor( top + $featuredMedia.outerHeight() - beforeOffset),
				widowWidth = $window.width();

		jQuery('.video-close-btn').click(function() {
			$featuredMedia.removeClass('video-is-sticky').addClass('stop-sticky');
		});

		/*
		*  Twitter video dosen't load untile the page is loaded,
		* so we recalcualte the offset after the twitter video loaded.
		*/
		$window.on( 'resize load', function() {

			top = $featuredMedia.offset().top;
			offset = Math.floor( top + $featuredMedia.outerHeight() - beforeOffset);
			widowWidth = $window.width();

			/*
			* if the page has a sidebar, sticky the video at the top of it with the same width.
			*/
			if( $body.hasClass('has-sidebar') ){
				var $sidebar = jQuery('.sidebar'),
						sidebarWidth = $sidebar.width(),
						sidebarPadding = ($body.hasClass('magazine2') && $body.hasClass('sidebar-right')) ? 40 : 15,
						sidebarRightOffset = $window.width() - ($sidebar.offset().left + sidebarWidth);

				$featuredMedia.find('.featured-area-inner').css({
					width: sidebarWidth,
					height: sidebarWidth * (9/16),
					right: sidebarRightOffset - sidebarPadding,
					left: "auto",
					top: beforeOffset + 20
				});
			}

		}).on( 'scroll', function() {
			if( ! $featuredMedia.hasClass('stop-sticky') ){
				$featuredMedia.toggleClass('video-is-sticky', $window.scrollTop() > offset && widowWidth > 992 );
			}
		});

	}


	/**
	 * Reading Position Indicator
	 */
	if( tie.reading_indicator && $postContent.length ){

		$postContent.imagesLoaded(function(){
			var content_height  = $postContent.height(),
					window_height   = $window.height();

			$window.scroll(function(){
				var percent        = 0,
						content_offset = $postContent.offset().top,
						window_offest  = $window.scrollTop();

				if (window_offest > content_offset){
					percent = 100 * (window_offest - content_offset) / (content_height - window_height);
				}

				jQuery('#reading-position-indicator').css('width', percent + '%');
			});
		});

	}


	/**
	 * Check Also Box
	 */
	var $check_also_box = jQuery('#check-also-box');
	if( $check_also_box.length ){

		// LazyLoad
		tie_animate_element( $check_also_box );

		var articleHeight   = $the_post.outerHeight(),
				checkAlsoClosed = false;

		$window.scroll(function(){
			if( ! checkAlsoClosed ){
				var articleScroll = $window.scrollTop();
				if ( articleScroll > articleHeight ){
					$check_also_box.addClass('show-check-also');
				}
				else {
					$check_also_box.removeClass('show-check-also');
				}
			}
		});
	}

	jQuery('#check-also-close').on( 'click', function(){
		$check_also_box.removeClass('show-check-also');
		checkAlsoClosed = true ;
		return false;
	});


	/**
	 * Select and Share
	 */
	if( tie.select_share ){

		$postContent.mousedown(function (event){

			$body.attr('mouse-top',event.clientY+window.pageYOffset);
			$body.attr('mouse-left',event.clientX);
			if(!getRightClick(event) && getSelectionText().length){
				jQuery('.fly-text-share').remove();
				document.getSelection().removeAllRanges();
			}
		});

		$postContent.mouseup(function (event){

			var t  = jQuery(event.target),
					st = getSelectionText(),
					ds = st;

			if(st.length > 3 && !getRightClick(event)){
				var mts = $body.attr('mouse-top'),
						mte = event.clientY+window.pageYOffset;

				if( parseInt(mts) < parseInt(mte) ) mte = mts;

				var mlp = $body.attr('mouse-left'),
						mrp = event.clientX,
						ml  = parseInt(mlp)+(parseInt(mrp)-parseInt(mlp))/2,
						sl  = window.location.href.split('?')[0],
						maxl = 114;

				st   = st.substring(0,maxl);

				if( tie.twitter_username ){
					maxl = maxl - ( tie.twitter_username.length+2 );
					st   = st.substring(0,maxl);
					st   = st+' @'+tie.twitter_username;
				}

				var share_content = '';

				if( tie.select_share_twitter ){
					share_content += "<a href=\"https://twitter.com/share?url="+encodeURIComponent(sl)+"&text="+encodeURIComponent(st)+"\" class='fa fa-twitter' onclick=\"window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600\');return false;\"></a>";
				}

				if( tie.select_share_facebook && tie.facebook_app_id ){
					share_content += "<a href=\"https://www.facebook.com/dialog/feed?app_id="+tie.facebook_app_id+"&amp;link="+encodeURIComponent(sl)+"&amp;quote="+encodeURIComponent(ds)+"\" class='fa fa-facebook' onclick=\"window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600\');return false;\"></a>";
				}

				if( tie.select_share_linkedin ){
					share_content += "<a href=\"https://www.linkedin.com/shareArticle?mini=true&url="+encodeURIComponent(sl)+"&summary="+encodeURIComponent(ds)+"\" class='fa fa-linkedin' onclick=\"window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600\');return false;\"></a>";
				}

				if( tie.select_share_email ){
					share_content += "<a href=\"mailto:?body="+encodeURIComponent(ds)+" "+encodeURIComponent(sl)+"\" class='fa fa-envelope' onclick=\"window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;\"></a>";
				}

				if( share_content != '' ){
					$body.append( "<div class=\"fly-text-share\">"+ share_content +"</div>" );
				}

				jQuery('.fly-text-share').css({
					position: 'absolute',
					top     : parseInt(mte)-60,
					left    : parseInt(ml)
				}).show();
			}
		});
	}

	function getRightClick(e){
		var rightclick;
		if (!e) var e = window.event;
		if (e.which) rightclick = (e.which == 3);
		else if (e.button) rightclick = (e.button == 2);
		return rightclick;
	}

	function getSelectionText(){
		var text = '';
		if (window.getSelection){
			text = window.getSelection().toString();
		}
		else if (document.selection && document.selection.type != "Control"){
			text = document.selection.createRange().text;
		}
		return text;
	}


	/**
	 * Taqyeem scripts
	 */
	// MOUSEMOVE HANDLER
	$doc.on( 'mousemove', '.taq-user-rate-active', function(e){
		var $rated = jQuery(this);

		if( $rated.hasClass('rated-done') ){
			return false;
		}

		if( !e.offsetX ){
			e.offsetX = e.clientX - jQuery(e.target).offset().left;
		}

		// Custom Code for the theme
		var offset = e.offsetX,
				width = $rated.width(),
		score = Math.round((offset/width)*100);

		$rated.find('.user-rate-image span').attr( 'data-user-rate', score ).css('width', score + '%');
	});

	// CLICK HANDLER
	$doc.on( 'click', '.taq-user-rate-active', function(){

		var $rated = jQuery(this),
				$ratedParent = $rated.parent(),
				$ratedCount  = $ratedParent.find('.taq-count'),
				post_id      = $rated.attr( 'data-id' ),
				numVotes     = $ratedCount.text();

		if( $rated.hasClass('rated-done') || $rated.hasClass('rated-in-progress') ){
			return false;
		}

		$rated.addClass('rated-in-progress');

		// Custom Code for the theme
		var userRatedValue = $rated.find('.user-rate-image span').data('user-rate');
		$rated.find( '.user-rate-image' ).hide();
		$rated.append('<span class="taq-load">'+ tie.ajax_loader  +'</span>');
		// --------

		if (userRatedValue >= 95) {
			userRatedValue = 100;
		}

		var userRatedValueCalc = (userRatedValue*5)/100;

		// Ajax Call
		jQuery.post(
			taqyeem.ajaxurl,
			{
				action: 'taqyeem_rate_post',
				post  : post_id,
				value : userRatedValueCalc
			},
			function( data ) {
				$rated.addClass('rated-done').attr('data-rate',userRatedValue);
				$rated.find('.user-rate-image span').width(userRatedValue+'%');

				jQuery('.taq-load').fadeOut(function () {
					$ratedParent.find('.taq-score').html( userRatedValueCalc );

					if( $ratedCount.length ){
						numVotes =  parseInt(numVotes)+1;
						$ratedCount.html(numVotes);
					}
					else{
						$ratedParent.find('small').hide();
					}

					$ratedParent.find('strong').html(taqyeem.your_rating);
					$rated.find('.user-rate-image').fadeIn();
			});
		}, 'html');

		return false;
	});

	// MOUSELEAVE HANDLER
	$doc.on( 'mouseleave', '.taq-user-rate-active', function(){
		var $rated = jQuery(this);
		if( $rated.hasClass('rated-done') ){
			return false;
		}
		var post_rate = $rated.attr('data-rate');
		$rated.find('.user-rate-image span').css('width', post_rate + '%');
	});

});
