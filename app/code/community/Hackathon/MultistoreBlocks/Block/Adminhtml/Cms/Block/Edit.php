<?php
/**
 * Multistoreview Cms Block edit
 *
 * @author Jeroen Boersma <jeroen@srcode.nl>
 * @author Willem Wigman <info@willemwigman.nl>
 * @author Peter Jaap Blaakmeer <peterjaap@elgentos.nl>
 */


/**
 * @package Hackathon_MultistoreBlocks
 * @category Hackathon
 */
class Hackathon_MultistoreBlocks_Block_Adminhtml_Cms_Block_Edit extends Mage_Adminhtml_Block_Cms_Block_Edit
{

    /**
     * Prepare editing
     */
    public function __construct()
    {
        $this->_objectId = 'block_id';
        $this->_controller = 'cms_block';

        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('cms')->__('Save Block'));
        $this->_updateButton('delete', 'label', Mage::helper('cms')->__('Delete Block'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_addScripts();
    }

    /**
     * Add scripts
     *
     * return void
     */
    protected function _addScripts() {

        // Functional scripts
        $this->_formScripts[] = "
            function toggleEditor() {

                var textareas = document.getElementsByTagName('textarea'),
                    forEach = Array.prototype.forEach,
                    regex = /^block_multilanguage_content.*$/;

                forEach.call(textareas, function (contentElem) {
                    if (contentElem.id !== undefined && regex.test(contentElem.id)) {
                        if (tinyMCE.getInstanceById(contentElem.id) == null) {
                            tinyMCE.execCommand('mceAddControl', false, contentElem.id);
                        } else {
                            tinyMCE.execCommand('mceRemoveControl', false, contentElem.id);
                        }
                    }
                })

            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";

    }

}
