<?php

namespace src;

class CustomTaxonomyWidget extends \WP_Widget {

    public function __construct() {
        parent::__construct(
        // Base ID of your widget
            'custom_taxonomy_widget',
            // Widget name will appear in UI
            esc_html__( 'Виджет кастомных таксономий', 'text_domain' ),
            // Widget description
            array( 'description' => esc_html__( 'A widget for displaying custom taxonomy terms', 'text_domain' ), )
        );
    }

    public static function init()
    {
        add_action( 'widgets_init', [__CLASS__, 'register_custom_taxonomy_widget']);
    }

    // Creating widget front-end
    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        // Получаем текущее значение выбранной таксономии
        $selected_taxonomy = ! empty( $instance['taxonomy'] ) ? $instance['taxonomy'] : 'dish';

        // Получаем данные из выбранной таксономии
        $terms = get_terms( array(
            'taxonomy' => $selected_taxonomy,
            'hide_empty' => false,
        ) );

        // Выводим title
        $title = ! empty( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) : '';
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        // Выводим данные в виджете
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            echo '<ul class="widget_custom_taxonomy_widget_list">';
            foreach ( $terms as $term ) {
                echo '<li><a href="' . get_term_link( $term ) . '">' . $term->name . '</a></li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No terms found</p>';
        }

        echo $args['after_widget'];

    }

    public function form( $instance ) {
        // Получаем текущее значение поля title из настроек виджета
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'wpb_widget_domain' );

        // Получаем текущее значение выбранной таксономии
        $selected_taxonomy = ! empty( $instance['taxonomy'] ) ? $instance['taxonomy'] : 'dish';

        // Выводим форму настройки виджета
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'taxonomy' ); ?>"><?php _e( 'Select Taxonomy:' ); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'taxonomy' ); ?>" name="<?php echo $this->get_field_name( 'taxonomy' ); ?>">
                <?php
                // Получаем список всех зарегистрированных таксономий
                $taxonomies = get_taxonomies( array(), 'objects' );
                foreach ( $taxonomies as $taxonomy ) {
                    echo '<option value="' . esc_attr( $taxonomy->name ) . '" ' . selected( $selected_taxonomy, $taxonomy->name, false ) . '>' . esc_html( $taxonomy->label ) . '</option>';
                }
                ?>
            </select>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();

        // Сохраняем значение title
        $instance['title'] = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';

        // Сохраняем значение taxonomy
        $instance['taxonomy'] = ! empty( $new_instance['taxonomy'] ) ? sanitize_text_field( $new_instance['taxonomy'] ) : '';

        return $instance;
    }

    public static function register_custom_taxonomy_widget() {
//        register_widget( 'custom_taxonomy_widget' );
        register_widget( __NAMESPACE__ . '\CustomTaxonomyWidget' );
    }
}
