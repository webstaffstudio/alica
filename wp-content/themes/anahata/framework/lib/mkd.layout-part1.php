<?php

/*
   Interface: iAnahataMikadoLayoutNode
   A interface that implements Layout Node methods
*/

interface iAnahataMikadoLayoutNode {
    public function hasChidren();

    public function getChild($key);

    public function addChild($key, $value);
}

/*
   Interface: iAnahataMikadoRender
   A interface that implements Render methods
*/

interface iAnahataMikadoRender {
    public function render($factory);
}

/*
   Class: AnahataMikadoPanel
   A class that initializes Mikado Panel
*/

class AnahataMikadoPanel implements iAnahataMikadoLayoutNode, iAnahataMikadoRender {

    public $children;
    public $title;
    public $name;
    public $hidden_property;
    public $hidden_value;
    public $hidden_values;

    function __construct($title_label = "", $name = "", $hidden_property = "", $hidden_value = "", $hidden_values = array()) {
        $this->children        = array();
        $this->title           = $title_label;
        $this->name            = $name;
        $this->hidden_property = $hidden_property;
        $this->hidden_value    = $hidden_value;
        $this->hidden_values   = $hidden_values;
    }

    public function hasChidren() {
        return (count($this->children) > 0) ? true : false;
    }

    public function getChild($key) {
        return $this->children[$key];
    }

    public function addChild($key, $value) {
        $this->children[$key] = $value;
    }

    public function render($factory) {
        $hidden = false;
        if(!empty($this->hidden_property)) {
            if(anahata_mikado_option_get_value($this->hidden_property) == $this->hidden_value) {
                $hidden = true;
            } else {
                foreach($this->hidden_values as $value) {
                    if(anahata_mikado_option_get_value($this->hidden_property) == $value) {
                        $hidden = true;
                    }

                }
            }
        }
        ?>
        <div class="mkd-page-form-section-holder" id="mkd_<?php echo esc_attr($this->name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>>
            <h3 class="mkd-page-section-title"><?php echo esc_html($this->title); ?></h3>
            <?php
            foreach($this->children as $child) {
                $this->renderChild($child, $factory);
            }
            ?>
        </div>
    <?php
    }

    public function renderChild(iAnahataMikadoRender $child, $factory) {
        $child->render($factory);
    }
}

/*
   Class: AnahataMikadoContainer
   A class that initializes Mikado Container
*/

class AnahataMikadoContainer implements iAnahataMikadoLayoutNode, iAnahataMikadoRender {

    public $children;
    public $name;
    public $hidden_property;
    public $hidden_value;
    public $hidden_values;

    function __construct($name = "", $hidden_property = "", $hidden_value = "", $hidden_values = array()) {
        $this->children        = array();
        $this->name            = $name;
        $this->hidden_property = $hidden_property;
        $this->hidden_value    = $hidden_value;
        $this->hidden_values   = $hidden_values;
    }

    public function hasChidren() {
        return (count($this->children) > 0) ? true : false;
    }

    public function getChild($key) {
        return $this->children[$key];
    }

    public function addChild($key, $value) {
        $this->children[$key] = $value;
    }

    public function render($factory) {
        $hidden = false;
        if(!empty($this->hidden_property)) {
            if(anahata_mikado_option_get_value($this->hidden_property) == $this->hidden_value) {
                $hidden = true;
            } else {
                foreach($this->hidden_values as $value) {
                    if(anahata_mikado_option_get_value($this->hidden_property) == $value) {
                        $hidden = true;
                    }

                }
            }
        }
        ?>
        <div class="mkd-page-form-container-holder" id="mkd_<?php echo esc_attr($this->name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>>
            <?php
            foreach($this->children as $child) {
                $this->renderChild($child, $factory);
            }
            ?>
        </div>
    <?php
    }

    public function renderChild(iAnahataMikadoRender $child, $factory) {
        $child->render($factory);
    }
}


/*
   Class: AnahataMikadoContainerNoStyle
   A class that initializes Mikado Container without css classes
*/

class AnahataMikadoContainerNoStyle implements iAnahataMikadoLayoutNode, iAnahataMikadoRender {

    public $children;
    public $name;
    public $hidden_property;
    public $hidden_value;
    public $hidden_values;

    function __construct($name = "", $hidden_property = "", $hidden_value = "", $hidden_values = array()) {
        $this->children        = array();
        $this->name            = $name;
        $this->hidden_property = $hidden_property;
        $this->hidden_value    = $hidden_value;
        $this->hidden_values   = $hidden_values;
    }

    public function hasChidren() {
        return (count($this->children) > 0) ? true : false;
    }

    public function getChild($key) {
        return $this->children[$key];
    }

    public function addChild($key, $value) {
        $this->children[$key] = $value;
    }

    public function render($factory) {
        $hidden = false;
        if(!empty($this->hidden_property)) {
            if(anahata_mikado_option_get_value($this->hidden_property) == $this->hidden_value) {
                $hidden = true;
            } else {
                foreach($this->hidden_values as $value) {
                    if(anahata_mikado_option_get_value($this->hidden_property) == $value) {
                        $hidden = true;
                    }

                }
            }
        }
        ?>
        <div id="mkd_<?php echo esc_attr($this->name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>>
            <?php
            foreach($this->children as $child) {
                $this->renderChild($child, $factory);
            }
            ?>
        </div>
    <?php
    }

    public function renderChild(iAnahataMikadoRender $child, $factory) {
        $child->render($factory);
    }
}

/*
   Class: AnahataMikadoGroup
   A class that initializes Mikado Group
*/

class AnahataMikadoGroup implements iAnahataMikadoLayoutNode, iAnahataMikadoRender {

    public $children;
    public $title;
    public $description;

    function __construct($title_label = "", $description = "") {
        $this->children    = array();
        $this->title       = $title_label;
        $this->description = $description;
    }

    public function hasChidren() {
        return (count($this->children) > 0) ? true : false;
    }

    public function getChild($key) {
        return $this->children[$key];
    }

    public function addChild($key, $value) {
        $this->children[$key] = $value;
    }

    public function render($factory) {
        ?>

        <div class="mkd-page-form-section">


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($this->title); ?></h4>

                <p><?php echo esc_html($this->description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->

            <div class="mkd-section-content">
                <div class="container-fluid">
                    <?php
                    foreach($this->children as $child) {
                        $this->renderChild($child, $factory);
                    }
                    ?>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php
    }

    public function renderChild(iAnahataMikadoRender $child, $factory) {
        $child->render($factory);
    }
}

/*
   Class: AnahataMikadoNotice
   A class that initializes Mikado Notice
*/

class AnahataMikadoNotice implements iAnahataMikadoRender {

    public $children;
    public $title;
    public $description;
    public $notice;
    public $hidden_property;
    public $hidden_value;
    public $hidden_values;

    function __construct($title_label = "", $description = "", $notice = "", $hidden_property = "", $hidden_value = "", $hidden_values = array()) {
        $this->children        = array();
        $this->title           = $title_label;
        $this->description     = $description;
        $this->notice          = $notice;
        $this->hidden_property = $hidden_property;
        $this->hidden_value    = $hidden_value;
        $this->hidden_values   = $hidden_values;
    }

    public function render($factory) {
        $hidden = false;
        if(!empty($this->hidden_property)) {
            if(anahata_mikado_option_get_value($this->hidden_property) == $this->hidden_value) {
                $hidden = true;
            } else {
                foreach($this->hidden_values as $value) {
                    if(anahata_mikado_option_get_value($this->hidden_property) == $value) {
                        $hidden = true;
                    }

                }
            }
        }
        ?>

        <div class="mkd-page-form-section"<?php if($hidden) { ?> style="display: none"<?php } ?>>


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($this->title); ?></h4>

                <p><?php echo esc_html($this->description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->

            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="alert alert-warning">
                        <?php echo esc_html($this->notice); ?>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php
    }
}

/*
   Class: AnahataMikadoRow
   A class that initializes Mikado Row
*/

class AnahataMikadoRow implements iAnahataMikadoLayoutNode, iAnahataMikadoRender {

    public $children;
    public $next;

    function __construct($next = false) {
        $this->children = array();
        $this->next     = $next;
    }

    public function hasChidren() {
        return (count($this->children) > 0) ? true : false;
    }

    public function getChild($key) {
        return $this->children[$key];
    }

    public function addChild($key, $value) {
        $this->children[$key] = $value;
    }

    public function render($factory) {
        ?>
        <div class="row<?php if($this->next) {
            echo " next-row";
        } ?>">
            <?php
            foreach($this->children as $child) {
                $this->renderChild($child, $factory);
            }
            ?>
        </div>
    <?php
    }

    public function renderChild(iAnahataMikadoRender $child, $factory) {
        $child->render($factory);
    }
}

/*
   Class: AnahataMikadoTitle
   A class that initializes Mikado Title
*/

class AnahataMikadoTitle implements iAnahataMikadoRender {
    private $name;
    private $title;
    public $hidden_property;
    public $hidden_values = array();

    function __construct($name = "", $title_label = "", $hidden_property = "", $hidden_value = "") {
        $this->title           = $title_label;
        $this->name            = $name;
        $this->hidden_property = $hidden_property;
        $this->hidden_value    = $hidden_value;
    }

    public function render($factory) {
        $hidden = false;
        if(!empty($this->hidden_property)) {
            if(anahata_mikado_option_get_value($this->hidden_property) == $this->hidden_value) {
                $hidden = true;
            }
        }
        ?>
        <h5 class="mkd-page-section-subtitle" id="mkd_<?php echo esc_attr($this->name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>><?php echo esc_html($this->title); ?></h5>
    <?php
    }
}

/*
   Class: AnahataMikadoField
   A class that initializes Mikado Field
*/

class AnahataMikadoField implements iAnahataMikadoRender {
    private $type;
    private $name;
    private $default_value;
    private $label;
    private $description;
    private $options = array();
    private $args = array();
    public $hidden_property;
    public $hidden_values = array();


    function __construct($type, $name, $default_value = "", $label = "", $description = "", $options = array(), $args = array(), $hidden_property = "", $hidden_values = array()) {
        global $anahata_Framework;
        $this->type            = $type;
        $this->name            = $name;
        $this->default_value   = $default_value;
        $this->label           = $label;
        $this->description     = $description;
        $this->options         = $options;
        $this->args            = $args;
        $this->hidden_property = $hidden_property;
        $this->hidden_values   = $hidden_values;
        $anahata_Framework->mkdOptions->addOption($this->name, $this->default_value, $type);
    }

    public function render($factory) {
        $hidden = false;
        if(!empty($this->hidden_property)) {
            foreach($this->hidden_values as $value) {
                if(anahata_mikado_option_get_value($this->hidden_property) == $value) {
                    $hidden = true;
                }

            }
        }
        $factory->render($this->type, $this->name, $this->label, $this->description, $this->options, $this->args, $hidden);
    }
}

/*
   Class: AnahataMikadoMetaField
   A class that initializes Mikado Meta Field
*/

class AnahataMikadoMetaField implements iAnahataMikadoRender {
    private $type;
    private $name;
    private $default_value;
    private $label;
    private $description;
    private $options = array();
    private $args = array();
    public $hidden_property;
    public $hidden_values = array();


    function __construct($type, $name, $default_value = "", $label = "", $description = "", $options = array(), $args = array(), $hidden_property = "", $hidden_values = array()) {
        global $anahata_Framework;
        $this->type            = $type;
        $this->name            = $name;
        $this->default_value   = $default_value;
        $this->label           = $label;
        $this->description     = $description;
        $this->options         = $options;
        $this->args            = $args;
        $this->hidden_property = $hidden_property;
        $this->hidden_values   = $hidden_values;
        $anahata_Framework->mkdMetaBoxes->addOption($this->name, $this->default_value);
    }

    public function render($factory) {
        $hidden = false;
        if(!empty($this->hidden_property)) {
            foreach($this->hidden_values as $value) {
                if(anahata_mikado_option_get_value($this->hidden_property) == $value) {
                    $hidden = true;
                }

            }
        }
        $factory->render($this->type, $this->name, $this->label, $this->description, $this->options, $this->args, $hidden);
    }
}

abstract class AnahataMikadoFieldType {

    abstract public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false);

}

class AnahataMikadoFieldText extends AnahataMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        $col_width = 12;
        if(isset($args["col_width"])) {
            $col_width = $args["col_width"];
        }

        $suffix = !empty($args['suffix']) ? $args['suffix'] : false;

        ?>

        <div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>>


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->

            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-<?php echo esc_attr($col_width); ?>">
                            <?php if($suffix) : ?>
                            <div class="input-group">
                                <?php endif; ?>
                                <input type="text"
                                       class="form-control mkd-input mkd-form-element"
                                       name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(htmlspecialchars(anahata_mikado_option_get_value($name))); ?>"
                                       />
                                <?php if($suffix) : ?>
                                    <div class="input-group-addon"><?php echo esc_html($args['suffix']); ?></div>
                                <?php endif; ?>
                                <?php if($suffix) : ?>
                            </div>
                        <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php

    }

}

class AnahataMikadoFieldTextSimple extends AnahataMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {

        $suffix = !empty($args['suffix']) ? $args['suffix'] : false;

        ?>


        <div class="col-lg-3" id="mkd_<?php echo esc_attr($name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>>
            <em class="mkd-field-description"><?php echo esc_html($label); ?></em>
            <?php if($suffix) : ?>
            <div class="input-group">
                <?php endif; ?>
                <input type="text"
                       class="form-control mkd-input mkd-form-element"
                       name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(htmlspecialchars(anahata_mikado_option_get_value($name))); ?>"
                       />
                <?php if($suffix) : ?>
                    <div class="input-group-addon"><?php echo esc_html($args['suffix']); ?></div>
                <?php endif; ?>
                <?php if($suffix) : ?>
            </div>
        <?php endif; ?>
        </div>
    <?php

    }

}

class AnahataMikadoFieldTextArea extends AnahataMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        ?>

        <div class="mkd-page-form-section">


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->


            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
							<textarea class="form-control mkd-form-element"
                                      name="<?php echo esc_attr($name); ?>"
                                      rows="5"><?php echo esc_html(htmlspecialchars(anahata_mikado_option_get_value($name))); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php

    }

}

class AnahataMikadoFieldTextAreaSimple extends AnahataMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        ?>

        <div class="col-lg-3">
            <em class="mkd-field-description"><?php echo esc_html($label); ?></em>
			<textarea class="form-control mkd-form-element"
                      name="<?php echo esc_attr($name); ?>"
                      rows="5"><?php echo esc_html(anahata_mikado_option_get_value($name)); ?></textarea>
        </div>
    <?php

    }

}

class AnahataMikadoFieldColor extends AnahataMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        ?>

        <div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>">


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->

            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(anahata_mikado_option_get_value($name)); ?>" class="my-color-field"/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php

    }

}

class AnahataMikadoFieldColorSimple extends AnahataMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $anahata_options;
        ?>

        <div class="col-lg-3" id="mkd_<?php echo esc_attr($name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>>
            <em class="mkd-field-description"><?php echo esc_html($label); ?></em>
            <input type="text" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(anahata_mikado_option_get_value($name)); ?>" class="my-color-field"/>
        </div>
    <?php

    }

}

class AnahataMikadoFieldImage extends AnahataMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $anahata_options;
        ?>

        <div class="mkd-page-form-section">


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->

            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mkd-media-uploader">
                                <div<?php if(!anahata_mikado_option_has_value($name)) { ?> style="display: none"<?php } ?>
                                    class="mkd-media-image-holder">
                                    <img src="<?php if(anahata_mikado_option_has_value($name)) {
                                        echo esc_url(anahata_mikado_get_attachment_thumb_url(anahata_mikado_option_get_value($name)));
                                    } ?>" alt="<?php esc_attr_e( 'Image thumbnail', 'anahata' ); ?>"
                                         class="mkd-media-image img-thumbnail"/>
                                </div>
                                <div style="display: none"
                                     class="mkd-media-meta-fields">
                                    <input type="hidden" class="mkd-media-upload-url"
                                           name="<?php echo esc_attr($name); ?>"
                                           value="<?php echo esc_attr(anahata_mikado_option_get_value($name)); ?>"/>
                                </div>
                                <a class="mkd-media-upload-btn btn btn-sm btn-primary"
                                   href="javascript:void(0)"
                                   data-frame-title="<?php esc_attr_e('Select Image', 'anahata'); ?>"
                                   data-frame-button-text="<?php esc_attr_e('Select Image', 'anahata'); ?>"><?php esc_html_e('Upload', 'anahata'); ?></a>
                                <a style="display: none;" href="javascript: void(0)"
                                   class="mkd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'anahata'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php

    }

}

class AnahataMikadoFieldImageSimple extends AnahataMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        ?>


        <div class="col-lg-3" id="mkd_<?php echo esc_attr($name); ?>"<?php if($hidden) { ?> style="display: none"<?php } ?>>
            <em class="mkd-field-description"><?php echo esc_html($label); ?></em>

            <div class="mkd-media-uploader">
                <div<?php if(!anahata_mikado_option_has_value($name)) { ?> style="display: none"<?php } ?>
                    class="mkd-media-image-holder">
                    <img src="<?php if(anahata_mikado_option_has_value($name)) {
                        echo esc_url(anahata_mikado_get_attachment_thumb_url(anahata_mikado_option_get_value($name)));
                    } ?>" alt="<?php esc_attr_e( 'Image thumbnail', 'anahata' ); ?>"
                         class="mkd-media-image img-thumbnail"/>
                </div>
                <div style="display: none"
                     class="mkd-media-meta-fields">
                    <input type="hidden" class="mkd-media-upload-url"
                           name="<?php echo esc_attr($name); ?>"
                           value="<?php echo esc_attr(anahata_mikado_option_get_value($name)); ?>"/>
                </div>
                <a class="mkd-media-upload-btn btn btn-sm btn-primary"
                   href="javascript:void(0)"
                   data-frame-title="<?php esc_attr_e('Select Image', 'anahata'); ?>"
                   data-frame-button-text="<?php esc_attr_e('Select Image', 'anahata'); ?>"><?php esc_html_e('Upload', 'anahata'); ?></a>
                <a style="display: none;" href="javascript: void(0)"
                   class="mkd-media-remove-btn btn btn-default btn-sm"><?php esc_html_e('Remove', 'anahata'); ?></a>
            </div>
        </div>
    <?php

    }

}

class AnahataMikadoFieldFont extends AnahataMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $anahata_options;
        global $anahata_fonts_array;
        ?>

        <div class="mkd-page-form-section">


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->


            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3">
                            <select class="form-control mkd-form-element"
                                    name="<?php echo esc_attr($name); ?>">
                                <option value="-1"><?php esc_html_e('Default', 'anahata'); ?></option>
                                <?php foreach($anahata_fonts_array as $fontArray) { ?>
                                    <option <?php if(anahata_mikado_option_get_value($name) == str_replace(' ', '+', $fontArray["family"])) {
                                        echo "selected='selected'";
                                    } ?> value="<?php echo esc_attr(str_replace(' ', '+', $fontArray["family"])); ?>"><?php echo esc_html($fontArray["family"]); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php

    }

}

class AnahataMikadoFieldFontSimple extends AnahataMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $anahata_options;
        global $anahata_fonts_array;
        ?>


        <div class="col-lg-3">
            <em class="mkd-field-description"><?php echo esc_html($label); ?></em>
            <select class="form-control mkd-form-element"
                    name="<?php echo esc_attr($name); ?>">
                <option value="-1"><?php esc_html_e('Default', 'anahata'); ?></option>
                <?php foreach($anahata_fonts_array as $fontArray) { ?>
                    <option <?php if(anahata_mikado_option_get_value($name) == str_replace(' ', '+', $fontArray["family"])) {
                        echo "selected='selected'";
                    } ?> value="<?php echo esc_attr(str_replace(' ', '+', $fontArray["family"])); ?>"><?php echo esc_html($fontArray["family"]); ?></option>
                <?php } ?>
            </select>
        </div>
    <?php

    }

}

class AnahataMikadoFieldSelect extends AnahataMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $anahata_options;
        $dependence = false;
        if(isset($args["dependence"])) {
            $dependence = true;
        }
        $show = array();
        if(isset($args["show"])) {
            $show = $args["show"];
        }
        $hide = array();
        if(isset($args["hide"])) {
            $hide = $args["hide"];
        }
        ?>

        <div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>" <?php if($hidden) { ?> style="display: none"<?php } ?>>


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->


            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3">
                            <select class="form-control mkd-form-element<?php if($dependence) {
                                echo " dependence";
                            } ?>"
                                <?php foreach($show as $key => $value) { ?>
                                    data-show-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                                <?php } ?>
                                <?php foreach($hide as $key => $value) { ?>
                                    data-hide-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                                <?php } ?>
                                    name="<?php echo esc_attr($name); ?>">
                                <?php foreach($options as $key => $value) {
                                    if($key == "-1") {
                                        $key = "";
                                    } ?>
                                    <option <?php if(anahata_mikado_option_get_value($name) == $key) {
                                        echo "selected='selected'";
                                    } ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php

    }

}

class AnahataMikadoFieldSelectBlank extends AnahataMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $anahata_options;
        $dependence = false;
        if(isset($args["dependence"])) {
            $dependence = true;
        }
        $show = array();
        if(isset($args["show"])) {
            $show = $args["show"];
        }
        $hide = array();
        if(isset($args["hide"])) {
            $hide = $args["hide"];
        }
        ?>

        <div class="mkd-page-form-section"<?php if($hidden) { ?> style="display: none"<?php } ?>>


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->


            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3">
                            <select class="form-control mkd-form-element<?php if($dependence) {
                                echo " dependence";
                            } ?>"
                                <?php foreach($show as $key => $value) { ?>
                                    data-show-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                                <?php } ?>
                                <?php foreach($hide as $key => $value) { ?>
                                    data-hide-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                                <?php } ?>
                                    name="<?php echo esc_attr($name); ?>">
                                <option <?php if(anahata_mikado_option_get_value($name) == "") {
                                    echo "selected='selected'";
                                } ?> value=""></option>
                                <?php foreach($options as $key => $value) {
                                    if($key == "-1") {
                                        $key = "";
                                    } ?>
                                    <option <?php if(anahata_mikado_option_get_value($name) == $key) {
                                        echo "selected='selected'";
                                    } ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php

    }

}

class AnahataMikadoFieldSelectSimple extends AnahataMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $anahata_options;
        $dependence = false;
        if(isset($args["dependence"])) {
            $dependence = true;
        }
        $show = array();
        if(isset($args["show"])) {
            $show = $args["show"];
        }
        $hide = array();
        if(isset($args["hide"])) {
            $hide = $args["hide"];
        }
        ?>


        <div class="col-lg-3">
            <em class="mkd-field-description"><?php echo esc_html($label); ?></em>
            <select class="form-control mkd-form-element<?php if($dependence) {
                echo " dependence";
            } ?>"
                <?php foreach($show as $key => $value) { ?>
                    data-show-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                <?php foreach($hide as $key => $value) { ?>
                    data-hide-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                    name="<?php echo esc_attr($name); ?>">
                <option <?php if(anahata_mikado_option_get_value($name) == "") {
                    echo "selected='selected'";
                } ?> value=""></option>
                <?php foreach($options as $key => $value) {
                    if($key == "-1") {
                        $key = "";
                    } ?>
                    <option <?php if(anahata_mikado_option_get_value($name) == $key) {
                        echo "selected='selected'";
                    } ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                <?php } ?>
            </select>
        </div>
    <?php

    }

}

class AnahataMikadoFieldSelectBlankSimple extends AnahataMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $anahata_options;
        $dependence = false;
        if(isset($args["dependence"])) {
            $dependence = true;
        }
        $show = array();
        if(isset($args["show"])) {
            $show = $args["show"];
        }
        $hide = array();
        if(isset($args["hide"])) {
            $hide = $args["hide"];
        }
        ?>


        <div class="col-lg-3">
            <em class="mkd-field-description"><?php echo esc_html($label); ?></em>
            <select class="form-control mkd-form-element<?php if($dependence) {
                echo " dependence";
            } ?>"
                <?php foreach($show as $key => $value) { ?>
                    data-show-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                <?php foreach($hide as $key => $value) { ?>
                    data-hide-<?php echo str_replace(' ', '', $key); ?>="<?php echo esc_attr($value); ?>"
                <?php } ?>
                    name="<?php echo esc_attr($name); ?>">
                <option <?php if(anahata_mikado_option_get_value($name) == "") {
                    echo "selected='selected'";
                } ?> value=""></option>
                <?php foreach($options as $key => $value) {
                    if($key == "-1") {
                        $key = "";
                    } ?>
                    <option <?php if(anahata_mikado_option_get_value($name) == $key) {
                        echo "selected='selected'";
                    } ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                <?php } ?>
            </select>
        </div>
    <?php

    }

}

class AnahataMikadoFieldYesNo extends AnahataMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $anahata_options;
        $dependence = false;
        if(isset($args["dependence"])) {
            $dependence = true;
        }
        $dependence_hide_on_yes = "";
        if(isset($args["dependence_hide_on_yes"])) {
            $dependence_hide_on_yes = $args["dependence_hide_on_yes"];
        }
        $dependence_show_on_yes = "";
        if(isset($args["dependence_show_on_yes"])) {
            $dependence_show_on_yes = $args["dependence_show_on_yes"];
        }
        ?>

        <div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>">


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->


            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       class="cb-enable<?php if(anahata_mikado_option_get_value($name) == "yes") {
                                           echo " selected";
                                       } ?><?php if($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('Yes', 'anahata') ?></span></label>
                                <label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       class="cb-disable<?php if(anahata_mikado_option_get_value($name) == "no") {
                                           echo " selected";
                                       } ?><?php if($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('No', 'anahata') ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                       name="<?php echo esc_attr($name); ?>_yesno" value="yes"<?php if(anahata_mikado_option_get_value($name) == "yes") {
                                    echo " selected";
                                } ?>/>
                                <input type="hidden" class="checkboxhidden_yesno" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(anahata_mikado_option_get_value($name)); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php

    }
}

class AnahataMikadoFieldYesNoSimple extends AnahataMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $anahata_options;
        $dependence = false;
        if(isset($args["dependence"])) {
            $dependence = true;
        }
        $dependence_hide_on_yes = "";
        if(isset($args["dependence_hide_on_yes"])) {
            $dependence_hide_on_yes = $args["dependence_hide_on_yes"];
        }
        $dependence_show_on_yes = "";
        if(isset($args["dependence_show_on_yes"])) {
            $dependence_show_on_yes = $args["dependence_show_on_yes"];
        }
        ?>

        <div class="col-lg-3">
            <em class="mkd-field-description"><?php echo esc_html($label); ?></em>

            <p class="field switch">
                <label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
                       class="cb-enable<?php if(anahata_mikado_option_get_value($name) == "yes") {
                           echo " selected";
                       } ?><?php if($dependence) {
                           echo " dependence";
                       } ?>"><span><?php esc_html_e('Yes', 'anahata') ?></span></label>
                <label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                       class="cb-disable<?php if(anahata_mikado_option_get_value($name) == "no") {
                           echo " selected";
                       } ?><?php if($dependence) {
                           echo " dependence";
                       } ?>"><span><?php esc_html_e('No', 'anahata') ?></span></label>
                <input type="checkbox" id="checkbox" class="checkbox"
                       name="<?php echo esc_attr($name); ?>_yesno" value="yes"<?php if(anahata_mikado_option_get_value($name) == "yes") {
                    echo " selected";
                } ?>/>
                <input type="hidden" class="checkboxhidden_yesno" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(anahata_mikado_option_get_value($name)); ?>"/>
            </p>
        </div>
    <?php

    }
}

class AnahataMikadoFieldOnOff extends AnahataMikadoFieldType {

    public function render($name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false) {
        global $anahata_options;
        $dependence = false;
        if(isset($args["dependence"])) {
            $dependence = true;
        }
        $dependence_hide_on_yes = "";
        if(isset($args["dependence_hide_on_yes"])) {
            $dependence_hide_on_yes = $args["dependence_hide_on_yes"];
        }
        $dependence_show_on_yes = "";
        if(isset($args["dependence_show_on_yes"])) {
            $dependence_show_on_yes = $args["dependence_show_on_yes"];
        }
        ?>

        <div class="mkd-page-form-section" id="mkd_<?php echo esc_attr($name); ?>">


            <div class="mkd-field-desc">
                <h4><?php echo esc_html($label); ?></h4>

                <p><?php echo esc_html($description); ?></p>
            </div>
            <!-- close div.mkd-field-desc -->


            <div class="mkd-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">

                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr($dependence_hide_on_yes); ?>" data-show="<?php echo esc_attr($dependence_show_on_yes); ?>"
                                       class="cb-enable<?php if(anahata_mikado_option_get_value($name) == "on") {
                                           echo " selected";
                                       } ?><?php if($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('On', 'anahata') ?></span></label>
                                <label data-hide="<?php echo esc_attr($dependence_show_on_yes); ?>" data-show="<?php echo esc_attr($dependence_hide_on_yes); ?>"
                                       class="cb-disable<?php if(anahata_mikado_option_get_value($name) == "off") {
                                           echo " selected";
                                       } ?><?php if($dependence) {
                                           echo " dependence";
                                       } ?>"><span><?php esc_html_e('Off', 'anahata') ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                       name="<?php echo esc_attr($name); ?>_onoff" value="on"<?php if(anahata_mikado_option_get_value($name) == "on") {
                                    echo " selected";
                                } ?>/>
                                <input type="hidden" class="checkboxhidden_onoff" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr(anahata_mikado_option_get_value($name)); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.mkd-section-content -->

        </div>
    <?php

    }

}