/**
 * Nordhouse — main.js
 * Vanilla JS, no dependencies. Foundations every section widget can hook
 * into: scroll-reveal via [data-reveal], smooth anchor nav, nav state.
 */
( function () {
	'use strict';

	/* ---------------------------------------------------------------------
	 * Scroll reveal
	 * Any element with [data-reveal] gets .is-visible when it enters
	 * the viewport. Optional [data-reveal-delay="120"] for stagger (ms).
	 * ------------------------------------------------------------------ */
	function initScrollReveal() {
		var items = document.querySelectorAll( '[data-reveal]' );
		if ( ! items.length ) return;

		if ( ! ( 'IntersectionObserver' in window ) ) {
			items.forEach( function ( el ) { el.classList.add( 'is-visible' ); } );
			return;
		}

		var observer = new IntersectionObserver(
			function ( entries ) {
				entries.forEach( function ( entry ) {
					if ( entry.isIntersecting ) {
						var delay = entry.target.getAttribute( 'data-reveal-delay' ) || 0;
						setTimeout( function () {
							entry.target.classList.add( 'is-visible' );
						}, parseInt( delay, 10 ) );
						observer.unobserve( entry.target );
					}
				} );
			},
			{ threshold: 0.15, rootMargin: '0px 0px -10% 0px' }
		);

		items.forEach( function ( el ) { observer.observe( el ); } );
	}

	/* ---------------------------------------------------------------------
	 * Smooth anchor navigation
	 * Works with [section_anchor_id] set on each section widget.
	 * ------------------------------------------------------------------ */
	function initAnchorNav() {
		document.addEventListener( 'click', function ( e ) {
			var link = e.target.closest( 'a[href^="#"]' );
			if ( ! link ) return;

			var id = link.getAttribute( 'href' ).slice( 1 );
			if ( ! id ) return;

			var target = document.getElementById( id );
			if ( ! target ) return;

			e.preventDefault();
			target.scrollIntoView( { behavior: 'smooth', block: 'start' } );
		} );
	}

	/* ---------------------------------------------------------------------
	 * Nav scroll state (for the navbar widget — e.g. background on scroll)
	 * ------------------------------------------------------------------ */
	function initNavScrollState() {
		var nav = document.querySelector( '[data-nordhouse-nav]' );
		if ( ! nav ) return;

		var toggle = function () {
			nav.classList.toggle( 'is-scrolled', window.scrollY > 20 );
		};

		toggle();
		window.addEventListener( 'scroll', toggle, { passive: true } );
	}

	document.addEventListener( 'DOMContentLoaded', function () {
		initScrollReveal();
		initAnchorNav();
		initNavScrollState();
	} );
} )();