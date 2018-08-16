
( function( $ ) {

    window.GPLimitCheckboxes = function( args ) {

        var self = this;

        // copy all args to current object: (list expected props)
        for( prop in args ) {
            if( args.hasOwnProperty( prop ) ) {
                self[ prop ] = args[ prop ];
            }
        }

        self.init = function() {

            if( window.GPLimitCheckboxes && ! window.GPLimitCheckboxes.instances ) {
                window.GPLimitCheckboxes.instances = {};
            }

            self.bindTriggerEvents();

            window.GPLimitCheckboxes.instances[ self.formId ] = self;

        };
    
        self.bindTriggerEvents = function() {

            var selectors = [];

            for( var i = 0; i < self.triggers.length; i++ ) {
                selectors.push( self.triggers[ i ].selector );
            }

            // Exclude choices that were already disabled so that they will always be disabled.
            $( selectors.join( ', ' ) ).filter( ':disabled' ).addClass( 'gplc-pre-disabled' );

            // Exclude Select All choices.
            $( selectors.join( ', ' ) ).filter( 'input[id$="select_all"]' ).addClass( 'gplc-select-all' );
 
            $( selectors.join( ', ' ) ).change( function() {
                self.handleCheckboxClick( $( this ) );
            } ).each( function() {
                self.handleCheckboxClick( $( this ) );
            } );

        };

        self.handleCheckboxClick = function( $elem ) {

            var disableFieldIds = [],
                enableFieldIds  = [],
                fieldId         = typeof $elem != 'undefined' ? parseInt( $elem.attr( 'id' ).split( '_' )[2] ) : null;

            // loops through ALL groups to make sure that overlapping groups are covered
            for( var i = 0; i < self.groups.length; i++ ) {

            	/**
	             * Filter the group that is about to be processed.
	             *
	             * @since 1.2
	             *
	             * @param object group             The current group.
	             * @param object $elem             A jQuery object of the element that triggered the event.
	             * @param object GPLimitCheckboxes The current instance of the GPLimitCheckboxes object.
	             */
                var group = gform.applyFilters( 'gplc_group', $.extend( true, {}, self.groups[ i ] ), fieldId, $elem, self );

                if( self.isGroupMaxed( group ) ) {
                    disableFieldIds = $.merge( disableFieldIds, group.fields );
                } else {
                    enableFieldIds = $.merge( enableFieldIds, group.fields );
                }

            }

            // remove disabled fields from the enableFieldIds array
            enableFieldIds = enableFieldIds.gplcDiff( disableFieldIds );

            // Enable applicable checkboxes.
            self.getCheckboxesByFieldIds( enableFieldIds ).not( '.gplc-pre-disabled, .gplc-select-all' ).attr( 'disabled', false );

            // Disable applicable checkboxes.
            self.getCheckboxesByFieldIds( disableFieldIds ).not( ':checked, .gplc-pre-disabled, .gplc-select-all' ).attr( 'disabled', true );

            // Supports GF 2.3 Select All option; uncheck any disabled checkbox that was not pre-disabled. Potential
	        // complications: this does not trigger onclick events.
	        self.getCheckboxesByFieldIds( disableFieldIds ).filter( ':checked:disabled:not( .gplc-pre-disabled )' ).attr( 'checked', false ).trigger( 'change' );

        };

        self.isGroupMaxed = function( group ) {
            var count = $( self.getSelector( group.fields ) ).filter( ':checked:not( .gplc-select-all )' ).length;
            return count >= group.max;
        };

        self.getSelector = function( fieldIds ) {

            var selectors = [];

            for( var i = 0; i < fieldIds.length; i++ ) {
                for( var j = 0; j < self.triggers.length; j++ ) {
                    if( fieldIds[i] == self.triggers[j].fieldId ) {
                        selectors.push( self.triggers[j].selector );
                        break;
                    }
                }
            }

            return selectors.join( ', ' );
        };

        self.getCheckboxesByFieldIds = function( fieldIds ) {
            return $( self.getSelector( fieldIds ) );
        };

        self.isFieldHidden = function( fieldId ) {
            var $field = $( '#input_' + self.formId + '_' + fieldId );
            return gformIsHidden( $field.children( ':first-child' ) );
        };

        self.init();

    };

} )( jQuery );

Array.prototype.gplcDiff = function( a ) {
    return this.filter( function( i ) { return a.indexOf( i ) < 0; } );
};

Array.prototype.gplcUnique = function(){
    var u = {}, a = [];
    for(var i = 0, l = this.length; i < l; ++i){
        if(u.hasOwnProperty(this[i])) {
            continue;
        }
        a.push(this[i]);
        u[this[i]] = 1;
    }
    return a;
};