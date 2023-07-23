<?php

class Elementor_map_functions extends \Elementor\Widget_Base {
    
        public function get_name() {
            return 'advanced_gmap';
        }
    
        public function get_title() {
            return esc_html__( 'Advanced G-map', 'advanced_gmap' );
        }
    
        public function get_icon() {
            return 'eicon-google-maps';
        }
    
        public function get_categories() {
            return [ 'basic' ];
        }
    
        public function get_keywords() {
            return [ 'map', 'gmap','advance','advance g-map','google' ];
        }

        public function get_script_depends() {
            return [ 'map-script', 'map' ];
        }
    

        protected function register_controls() {
    
            // Content Tab Start
    
            $this->start_controls_section(
                'section_title',
                [
                    'label' => esc_html__( 'Settings', 'advanced_gmap' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );
            $this->add_control(
                'map_type',
                [
                    'label' => esc_html__( 'Map Style', 'advanced_gmap' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'roadmap',
                    'options' => [
                        '' => esc_html__( 'Default', 'advanced_gmap' ),
                        'roadmap' => esc_html__( 'Roadmap', 'advanced_gmap' ),
                        'satellite'  => esc_html__( 'Satellite', 'advanced_gmap' ),
                        'hybrid' => esc_html__( 'Hybrid', 'advanced_gmap' ),
                        'terrain' => esc_html__( 'Terrain', 'advanced_gmap' ),
                    ],
                ]
            );
            $this->add_control(
                'zoom_level',
                [
                    'label' => esc_html__( 'Zoom Level', 'advanced_gmap' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => '5',
                    'options' => [
                        '' => esc_html__( 'Default', 'advanced_gmap' ),
                        '2' => esc_html__( '2', 'advanced_gmap' ),
                        '4'  => esc_html__( '4', 'advanced_gmap' ),
                        '6' => esc_html__( '6', 'advanced_gmap' ),
                        '8' => esc_html__( '8', 'advanced_gmap' ),
                        '10' => esc_html__( '10', 'advanced_gmap' ),
                        '12' => esc_html__( '12', 'advanced_gmap' ),
                        '14' => esc_html__( '14', 'advanced_gmap' ),
                        '16' => esc_html__( '16', 'advanced_gmap' ),
                        '18' => esc_html__( '18', 'advanced_gmap' ),
                    ],
                ]
            );

            $this->add_control(
                'custom_marker_url',
                [
                    'label' => esc_html__( 'Custom Marker Link', 'advanced_gmap' ),
                    'type' => \Elementor\Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'advanced_gmap' ),
                      'default' => [
                        'url' => 'https://cdn.pixabay.com/photo/2014/04/03/10/03/google-309740_1280.png',
                    ],
                    'label_block' => true,
                ]
            );
    
            $this->add_control(
                'markers',
                [
                    'label' => esc_html__( 'Marks List', 'advanced_gmap' ),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => [
                        [
                            'name' => 'lat',
                            'label' => esc_html__( 'lat', 'advanced_gmap' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__( '20.5937' , 'advanced_gmap' ),
                            'label_block' => true,
                        ],
                        [
                            'name' => 'lng',
                            'label' => esc_html__( 'Long', 'advanced_gmap' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__( '78.9629' , 'advanced_gmap' ),
                            'label_block' => true,
                        ],
                        [
                            'name' => 'tool_tip_content',
                            'label' => esc_html__( 'Content', 'advanced_gmap' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'default' => esc_html__( 'List Content' , 'advanced_gmap' ),
                            'show_label' => false,
                        ],
                        [
                            'name' => 'list_color',
                            'label' => esc_html__( 'Color', 'advanced_gmap' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
                            ],
                        ]
                    ],
                    'default' => [
                        [
                            'lat' => esc_html__( '20.5937', 'advanced_gmap' ),
                            'lng' => esc_html__( '78.9629', 'advanced_gmap' ),
                            'tool_tip_content' => esc_html__( 'Content Click the edit button to change this text.', 'advanced_gmap' ),
                        ]
                    ],
                    'tool_tip_content' => '{{{ tool_tip_content }}}',
                ]
            );
    
            $this->end_controls_section();
    
            // Content Tab End
    
    
            // Style Tab Start
    
            $this->start_controls_section(
                'section_title_style',
                [
                    'label' => esc_html__( 'Title', 'advanced_gmap' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );
    
            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Text Color', 'advanced_gmap' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .hello-world' => 'color: {{VALUE}};',
                    ],
                ]
            );
    
            $this->end_controls_section();
    
            // Style Tab End
    
        }
    
        protected function render() {
            $settings = $this->get_settings_for_display();
            // Loop through each item and convert it to the desired format
         function formatArrayWithoutQuotes(array $arr): string {
            $output = '[';
            foreach ($arr as $item) {
                $formattedItem = "{position : {lat:{$item['lat']},lng :{$item['lng']}}, title : \"<div class='agm_tooltip'>{$item['tool_tip_content']}</div>\",},";
                $output .= $formattedItem;
            }
            $output = rtrim($output, ','); // Remove the trailing comma
            $output .= ']';
            return $output;
        }
        
        // Get the formatted output
        $formattedOutput = formatArrayWithoutQuotes($settings['markers']);
            ?>
            <style>#map {  height: 500px;}
            .agm_tooltip{font-size: 15px;
    height: fit-content;
    width: 300px;}
        </style>    
            <div id="map"></div>

<script>
       async function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: <?php echo $settings['zoom_level'];?>,
      center: { lat: 20.5937, lng: 78.9629 },
      mapTypeId: '<?php echo $settings['map_type'];?>',
      mapId: "4504f8b37365c3d0",
    });

    // Create an info window to share between markers.
    const infoWindow = new google.maps.InfoWindow();

    // Assuming you have a list of tour stops with lat, lng, and title values in PHP
    const tourStops = <?php echo $formattedOutput; ?>;

    // Define the custom marker icon image
    const customIcon = {
      url:'<?php echo  $settings['custom_marker_url']['url'];?>',
      scaledSize: new google.maps.Size(40, 40), // Adjust the size of the icon
    };

    // Create the markers with custom icon
    tourStops.forEach(({ position, title }) => {
      const marker = new google.maps.Marker({
        position: new google.maps.LatLng(position.lat, position.lng),
        map: map,
        title: title,
        icon: customIcon, // Set the custom icon
      });

      // Add a click listener for each marker, and set up the info window.
      marker.addListener("click", () => {
        infoWindow.close();
        infoWindow.setContent(title);
        infoWindow.open(map, marker);
      });
    });
  }

initMap();
        </script>

            <?php
            
        }
    }