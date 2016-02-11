<?php

class cfs_true_false extends cfs_field
{

    function __construct() {
        $this->name = 'true_false';
        $this->label = __('True / False', 'cfs');
    }




    function html( $field ) {
        $field->value = ( 0 < (int) $field->value ) ? 1 : 0;
    ?>
        <span class="checkbox<?php echo $field->value ? ' active' : ''; ?>"></span>
        <span><?php echo $field->options['message']; ?></span>
        <input type="hidden" name="<?php echo $field->input_name; ?>" class="<?php echo $field->input_class; ?>" value="<?php echo $field->value; ?>" />
    <?php
    }




    function options_html( $key, $field ) {
    ?>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e( 'Message', 'cfs' ); ?></label>
                <p class="description"><?php _e( 'The text beside the checkbox', 'cfs' ); ?></p>
            </td>
            <td>
                <?php
                    CFS()->create_field( array(
                        'type' => 'text',
                        'input_name' => "cfs[fields][$key][options][message]",
                        'value' => $this->get_option( $field, 'message' ),
                    ) );
                ?>
            </td>
        </tr>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e( 'Validation', 'cfs' ); ?></label>
            </td>
            <td>
                <?php
                    CFS()->create_field(array(
                        'type' => 'true_false',
                        'input_name' => "cfs[fields][$key][options][required]",
                        'input_class' => 'true_false',
                        'value' => $this->get_option( $field, 'required' ),
                        'options' => array( 'message' => __( 'This is a required field', 'cfs' ) ),
                    ));
                ?>
            </td>
        </tr>
    <?php
    }




    function input_head( $field = null ) {
    ?>
        <script>
        (function($) {
            $(function() {
                $(document).on('cfs/ready', '.cfs_add_field', function() {
                    $('.cfs_true_false:not(.ready)').init_true_false();
                });
                $('.cfs_true_false').init_true_false();
            });

            $.fn.init_true_false = function() {
                this.each(function() {
                    var $this = $(this);
                    $this.addClass('ready');

                    // handle click
                    $this.find('span.checkbox').on('click', function() {
                        var val = $(this).hasClass('active') ? 0 : 1;
                        $(this).siblings('.true_false').val(val);
                        $(this).toggleClass('active');
                    });
                });
            }
        })(jQuery);
        </script>
    <?php
    }




    function format_value_for_api( $value, $field = null ) {
        return ( 0 < (int) $value ) ? 1 : 0;
    }
}
