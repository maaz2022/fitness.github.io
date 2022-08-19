<?php

namespace MasterAddons\Addons;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

use MasterAddons\Inc\Helper\Master_Addons_Helper;

class JLTMA_Blockquote extends Widget_Base
{

	public function get_name()
	{
		return "jltma-blockquote";
	}

	public function get_title()
	{
		return esc_html__('Blockquote', 'master-addons' );
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-blockquote';
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_keywords()
	{
		return ['blockquote', 'quotation', 'author said'];
	}

	public function get_help_url()
	{
		return 'https://master-addons.com/demos/blockquote-element/';
	}


	//Quote Blockquote
	protected function jltma_blockquote_content_section()
	{
		$this->start_controls_section(
			'jltma_blockquote_display',
			[
				'label' => esc_html__('Blockquote', 'master-addons' ),
			]
		);

		$this->add_control(
			'jltma_blockquote_text',
			[
				'label' => esc_html__('Content', 'master-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__('Architecture should speak of its time and place, but yearn for timelessness', 'master-addons' ),
			]
		);

		$this->add_control(
			'jltma_blockquote_author',
			[
				'label'       => esc_html__('Quote Author', 'master-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__('Scott Adams', 'master-addons' ),
			]
		);

		$this->end_controls_section();
	}


	protected function jltma_quote_text_section()
	{

		$this->start_controls_section(
			'text_style_section',
			[
				'label'     => __('Content', 'master-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE
			]
		);


		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'quote_background',
				'label'    => __('Background', 'master-addons' ),
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .jltma-blockquote',
				'default'  => '#404ace'
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label'       => __('Text Alignment', 'master-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'default'     => 'inherit',
				'options'     => Master_Addons_Helper::jltma_content_alignment(),
				'selectors' => [
					'{{WRAPPER}} .jltma-blockquote' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => __('Text Color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-blockquote p' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'scheme'   => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .jltma-blockquote p'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'block_border',
				'selector'  => '{{WRAPPER}} .jltma-blockquote',
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'jltma_blockquote_padding',
			[
				'label'         => esc_html__('Padding', 'master-addons' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => ['px', 'em', '%'],
				'selectors'     => [
					'{{WRAPPER}} .jltma-blockquote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();
	}


	/*--------------  Quote Symbol Section  ---------------*/
	protected function jltma_quote_symbol_section()
	{

		$this->start_controls_section(
			'quote_symbol_style_section',
			[
				'label'     => __('Quote Symbol', 'master-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'quote_symbol',
			[
				'label'        => __('Show quote symbol', 'master-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __('On', 'master-addons' ),
				'label_off'    => __('Off', 'master-addons' ),
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'quote_symbol_color',
			[
				'label'     => __('Quote symbol color', 'master-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jltma-blockquote cite:before' => 'color: {{VALUE}};'
				],
				'condition' => [
					'quote_symbol' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'quote_symbol_typography',
				'scheme'    => Typography::TYPOGRAPHY_3,
				'selector'  => '{{WRAPPER}} .jltma-blockquote cite:before',
				'condition' => [
					'quote_symbol' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'quote_symbol_margin',
			[
				'label'      => __('Margin', 'master-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .jltma-blockquote cite:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->end_controls_section();
	}


	protected function register_controls()
	{

		$this->jltma_blockquote_content_section();
		$this->jltma_quote_text_section();
		$this->jltma_quote_symbol_section();


		/**
		 * Content Tab: Docs Links
		 */
		$this->start_controls_section(
			'jltma_section_help_docs',
			[
				'label' => esc_html__('Help Docs', 'master-addons' ),
			]
		);


		$this->add_control(
			'help_doc_1',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/demos/blockquote-element/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/blockquote-element/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=sSCULgPFSHU" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);
		$this->end_controls_section();




		//Upgrade to Pro
		if (ma_el_fs()->is_not_paying()) {

			$this->start_controls_section(
				'jltma_section_pro_style_section',
				[
					'label' => esc_html__('Upgrade to Pro for More Features', 'master-addons' ),
				]
			);

			$this->add_control(
				'jltma_control_get_pro_style_tab',
				[
					'label' => esc_html__('Unlock more possibilities', 'master-addons' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'1' => [
							'title' => esc_html__('', 'master-addons' ),
							'icon' => 'fa fa-unlock-alt',
						],
					],
					'default' => '1',
					'description' => '<span class="pro-feature"> Upgrade to  <a href="' . ma_el_fs()->get_upgrade_url() . '" target="_blank">Pro Version</a> for more Elements with Customization Options.</span>'
				]
			);

			$this->end_controls_section();
		}
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
?>

		<blockquote class="wp-block-quote jltma-blockquote">
			<p class="jltma-text">
				<?php echo $this->parse_text_editor($settings['jltma_blockquote_text']); ?>
			</p>
			<cite>
				<?php echo $this->parse_text_editor($settings['jltma_blockquote_author']); ?>
			</cite>
		</blockquote>

<?php }
}
