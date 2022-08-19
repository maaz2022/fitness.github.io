<?php

namespace MasterAddons\Addons;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 8/18/19
 */

// Elementor Classes
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;

if (!defined('ABSPATH')) exit; // If this file is called directly, abort.



class JLTMA_Changelogs extends Widget_Base
{

	public function get_name()
	{
		return 'ma-changelog';
	}

	public function get_title()
	{
		return esc_html__('Changelog', 'master-addons' );
	}

	public function get_icon()
	{
		return 'jltma-icon eicon-history';
	}

	public function get_categories()
	{
		return ['master-addons'];
	}

	public function get_help_url()
	{
		return 'https://master-addons.com/changelogs/';
	}

	protected function register_controls()
	{

		/**
		 * Master Headlines Content Section
		 */
		$this->start_controls_section(
			'ma_el_changelog_content_section',
			[
				'label' => esc_html__('Changelog Content', 'master-addons' ),
			]
		);

		$this->add_control(
			'ma_el_changelog_heading',
			[
				'label' => esc_html__('Heading', 'master-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('1.1.1 [18th August 2019]', 'master-addons' ),
			]
		);



		$this->add_control(
			'ma_el_changelog_main_title',
			[
				'label'   => esc_html__('Main Title', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'Added',
				'options' => [
					'Added'  => esc_html__('Added', 'master-addons' ),
					'Fixed' => esc_html__('Fixed', 'master-addons' ),
					'Updated' => esc_html__('Updated', 'master-addons' ),
					'Removed' => esc_html__('Removed', 'master-addons' ),
					'Changed' => esc_html__('Changed', 'master-addons' ),
					'Note' => esc_html__('Note', 'master-addons' ),
					'Info' => esc_html__('Info', 'master-addons' ),
					'Language' => esc_html__('Language', 'master-addons' ),
				]
			]
		);
		$repeater = new Repeater();



		$repeater->add_control(
			'ma_el_changelog_title',
			[
				'label'   => esc_html__('Title', 'master-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'Fixed',
				'options' => [
					'Added'  => esc_html__('Added', 'master-addons' ),
					'Fixed' => esc_html__('Fixed', 'master-addons' ),
					'Updated' => esc_html__('Updated', 'master-addons' ),
					'Removed' => esc_html__('Removed', 'master-addons' ),
					'Changed' => esc_html__('Changed', 'master-addons' ),
					'Note' => esc_html__('Note', 'master-addons' ),
					'Info' => esc_html__('Info', 'master-addons' ),
					'Language' => esc_html__('Language', 'master-addons' ),
				]
			]
		);


		$repeater->add_control(
			'ma_el_changelog_content',
			[
				'label'                 => __('Content', 'master-addons' ),
				'type'                  => Controls_Manager::TEXTAREA,
				'default'               => __(
					'Changelog Contents. If you want to link them, enable option below.',
					'master-addons' 
				),
				'dynamic'               => [
					'active'   => true,
				],
			]
		);
		//
		//			$repeater->add_control(
		//				'ma_changelog_content_link',
		//				[
		//					'label'       => esc_html__( 'Content Link URL', 'master-addons' ),
		//					'type'        => Controls_Manager::URL,
		//					'label_block' => true,
		//					'default'     => [
		//						'url'         => '#',
		//						'is_external' => true,
		//					],
		//					'show_external' => true,
		//				]
		//			);


		$this->add_control(
			'changelog_tabs',
			[
				'type'                  => Controls_Manager::REPEATER,
				'default'               => [
					['ma_el_changelog_title' => esc_html__('Added', 'master-addons' )],
					['ma_el_changelog_title' => esc_html__('Fixed', 'master-addons' )],
				],
				'fields' 				=> $repeater->get_controls(),
				'title_field'           => '{{ma_el_changelog_title}}',
			]
		);


		$this->end_controls_section();





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
				'raw'             => sprintf(esc_html__('%1$s Live Demo %2$s', 'master-addons' ), '<a href="https://master-addons.com/changelogs/" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_2',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Documentation %2$s', 'master-addons' ), '<a href="https://master-addons.com/docs/addons/changelog-element/?utm_source=widget&utm_medium=panel&utm_campaign=dashboard" target="_blank" rel="noopener">', '</a>'),
				'content_classes' => 'jltma-editor-doc-links',
			]
		);

		$this->add_control(
			'help_doc_3',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf(esc_html__('%1$s Watch Video Tutorial %2$s', 'master-addons' ), '<a href="https://www.youtube.com/watch?v=qWRgJkFfBow" target="_blank" rel="noopener">', '</a>'),
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


		<div id="jltma-changelog-<?php echo esc_attr($this->get_id()); ?>" class="jltma-changelog">
			<?php if ($settings['ma_el_changelog_heading']) { ?>
				<h2 class="jltma-changelog-heading">
					<?php echo $this->parse_text_editor($settings['ma_el_changelog_heading']); ?>
				</h2>
			<?php } ?>

			<?php if ($settings['ma_el_changelog_main_title']) { ?>
				<h3 class="jltma-changelog-title">
					<?php echo $this->parse_text_editor($settings['ma_el_changelog_main_title']); ?>
				</h3>
			<?php } ?>

			<?php foreach ($settings['changelog_tabs'] as $index => $tab) { ?>
				<ul>
					<li>
						<span class="jltma-label jltma-<?php echo strtolower($tab['ma_el_changelog_title']); ?>">
							<?php echo $this->parse_text_editor($tab['ma_el_changelog_title']); ?>
						</span>
						<?php echo $this->parse_text_editor($tab['ma_el_changelog_content']); ?>
					</li>
				</ul>

			<?php } ?>

		</div>

<?php
	}
}
