<?php
class smprestaspeed extends Module {
	public function __construct() {
		$this->name = 'smprestaspeed';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'Kamruzzaman';
		$this->bootstrap = true;
		parent::__construct();
		$this->displayName = $this->l('PrestaShop Speed Optimized Modules');
		$this->description = $this->l('Use this module for increase your prestashop store speed performance. If you want to make a Online E-Commerce Store Using Prestashop, WordPress, Opencart, Laravel, Django. Please email Us : kamrulbd36@gmail.com ');
		$this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
	}
	public function install() {
		if (!parent::install()
			|| !$this->registerHook(array('displayFooter','displayBeforeBodyClosingTag'))
			)
			return false;
		return true;
	}
	public function uninstall() {
		if (!parent::uninstall()
			)
			return false;
		else
			return true;
	}
	public function SettingForm() {
		$default_lang = (int) Configuration::get('PS_LANG_DEFAULT');
		$this->fields_form[0]['form'] = array(
			'legend' => array(
				'title' => $this->l('Optimization Setting'),
			),
			'submit' => array(
				'title' => $this->l('Save'),
				'class' => 'button',
			),
		);
		$this->fields_form[0]['form']['input'][] = array(
    	    'type' => 'switch',
    	    'label' => $this->l('Smart cache for CSS'),
    	    'desc' => $this->l('Just Load Only one CSS Files'),
    	    'name' => 'PS_CSS_THEME_CACHE',
    	    'is_bool' => true,
    	    'default_val' => 1,
    	    'values' => array(
    	      array(
    	        'id' => 'PS_CSS_THEME_CACHE_on',
    	        'value' => 1,
    	        'label' => $this->l('Enabled')
    	        ),
    	      array(
    	        'id' => 'PS_CSS_THEME_CACHE_off',
    	        'value' => 0,
    	        'label' => $this->l('Disabled')
    	        )
    	    )
		);
		$this->fields_form[0]['form']['input'][] = array(
    	    'type' => 'switch',
    	    'label' => $this->l('Smart cache for JavaScript'),
    	    'desc' => $this->l('Just Load Only one JS Files'),
    	    'name' => 'PS_JS_THEME_CACHE',
    	    'is_bool' => true,
    	    'default_val' => 1,
    	    'values' => array(
    	      array(
    	        'id' => 'PS_JS_THEME_CACHE_on',
    	        'value' => 1,
    	        'label' => $this->l('Enabled')
    	        ),
    	      array(
    	        'id' => 'PS_JS_THEME_CACHE_off',
    	        'value' => 0,
    	        'label' => $this->l('Disabled')
    	        )
    	    )
    	);
		$this->fields_form[0]['form']['input'][] = array(
    	    'type' => 'switch',
    	    'label' => $this->l('Minify HTML'),
    	    'desc' => $this->l('You Can Enable or disable Minify HTML'),
    	    'name' => 'minify_html_active',
    	    'is_bool' => true,
    	    'default_val' => 1,
    	    'values' => array(
    	      array(
    	        'id' => 'minify_html_active_on',
    	        'value' => 1,
    	        'label' => $this->l('Enabled')
    	        ),
    	      array(
    	        'id' => 'minify_html_active_off',
    	        'value' => 0,
    	        'label' => $this->l('Disabled')
    	        )
    	    )
    	);
		$this->fields_form[0]['form']['input'][] = array(
    	    'type' => 'switch',
    	    'label' => $this->l('Minify Inline JavaScript'),
    	    'desc' => $this->l('This option is typically safe to set to Yes'),
    	    'name' => 'minify_javascript',
    	    'is_bool' => true,
    	    'default_val' => 1,
    	    'values' => array(
    	      array(
    	        'id' => 'minify_javascript_on',
    	        'value' => 1,
    	        'label' => $this->l('Enabled')
    	        ),
    	      array(
    	        'id' => 'minify_javascript_off',
    	        'value' => 0,
    	        'label' => $this->l('Disabled')
    	        )
    	    )
    	);
		$this->fields_form[0]['form']['input'][] = array(
    	    'type' => 'switch',
    	    'label' => $this->l('Remove HTML, JavaScript and CSS comments'),
    	    'desc' => $this->l('This option is typically safe to set to Yes'),
    	    'name' => 'minify_html_comments',
    	    'is_bool' => true,
    	    'default_val' => 1,
    	    'values' => array(
    	      array(
    	        'id' => 'minify_html_comments_on',
    	        'value' => 1,
    	        'label' => $this->l('Enabled')
    	        ),
    	      array(
    	        'id' => 'minify_html_comments_off',
    	        'value' => 0,
    	        'label' => $this->l('Disabled')
    	        )
    	    )
    	);
		$this->fields_form[0]['form']['input'][] = array(
    	    'type' => 'switch',
    	    'label' => $this->l('Remove XHTML closing tags from HTML5 void elements'),
    	    'desc' => $this->l('This option is typically safe to set to Yes'),
    	    'name' => 'minify_html_xhtml',
    	    'is_bool' => true,
    	    'default_val' => 1,
    	    'values' => array(
    	      array(
    	        'id' => 'minify_html_xhtml_on',
    	        'value' => 1,
    	        'label' => $this->l('Enabled')
    	        ),
    	      array(
    	        'id' => 'minify_html_xhtml_off',
    	        'value' => 0,
    	        'label' => $this->l('Disabled')
    	        )
    	    )
    	);
		$this->fields_form[0]['form']['input'][] = array(
    	    'type' => 'switch',
    	    'label' => $this->l('Remove relative domain from internal URLs'),
    	    'desc' => $this->l('This option is typically safe to set to Yes'),
    	    'name' => 'minify_html_relative',
    	    'is_bool' => true,
    	    'default_val' => 1,
    	    'values' => array(
    	      array(
    	        'id' => 'minify_html_relative_on',
    	        'value' => 1,
    	        'label' => $this->l('Enabled')
    	        ),
    	      array(
    	        'id' => 'minify_html_relative_off',
    	        'value' => 0,
    	        'label' => $this->l('Disabled')
    	        )
    	    )
    	);
		$this->fields_form[0]['form']['input'][] = array(
    	    'type' => 'switch',
    	    'label' => $this->l('Remove schemes (HTTP: and HTTPS:) from all URLs'),
    	    'desc' => $this->l('This option is typically best to leave as No'),
    	    'name' => 'minify_html_scheme',
    	    'is_bool' => true,
    	    'default_val' => 0,
    	    'values' => array(
    	      array(
    	        'id' => 'minify_html_scheme_on',
    	        'value' => 1,
    	        'label' => $this->l('Enabled')
    	        ),
    	      array(
    	        'id' => 'minify_html_scheme_off',
    	        'value' => 0,
    	        'label' => $this->l('Disabled')
    	        )
    	    )
    	);
		$helper = new HelperForm();
		$helper->module = $this;
		$helper->name_controller = $this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;
		foreach (Language::getLanguages(false) as $lang) {
			$helper->languages[] = array(
				'id_lang' => $lang['id_lang'],
				'iso_code' => $lang['iso_code'],
				'name' => $lang['name'],
				'is_default' => ($default_lang == $lang['id_lang'] ? 1 : 0),
			);
		}
		$helper->toolbar_btn = array(
			'save' => array(
				'desc' => $this->l('Save'),
				'href' => AdminController::$currentIndex . '&configure=' . $this->name . '&save' . $this->name . 'token=' . Tools::getAdminTokenLite('AdminModules'),
			),
		);
		$helper->default_form_language = $default_lang;
		$helper->allow_employee_form_lang = $default_lang;
		$helper->title = $this->displayName;
		$helper->show_toolbar = true;
		$helper->toolbar_scroll = true;
		$helper->submit_action = 'save' . $this->name;
		$languages = Language::getLanguages(false);
        $helper->fields_value['PS_CSS_THEME_CACHE'] = Configuration::get('PS_CSS_THEME_CACHE');
        $helper->fields_value['PS_JS_THEME_CACHE'] = Configuration::get('PS_JS_THEME_CACHE');
        $helper->fields_value['minify_html_active'] = Configuration::get('kgmminify_html_active');
        $helper->fields_value['minify_javascript'] = Configuration::get('kgmminify_javascript');
        $helper->fields_value['minify_html_comments'] = Configuration::get('kgmminify_html_comments');
        $helper->fields_value['minify_html_xhtml'] = Configuration::get('kgmminify_html_xhtml');
        $helper->fields_value['minify_html_relative'] = Configuration::get('kgmminify_html_relative');
        $helper->fields_value['minify_html_scheme'] = Configuration::get('kgmminify_html_scheme');
		return $helper;
	}
	public static function minifyFullContent($htmlContent,$smarty) {
    	if ( substr( ltrim( $htmlContent ), 0, 5) == '<?xml' ) return ( $htmlContent );
    	$minify_javascript = Configuration::get('kgmminify_javascript');
    	$minify_html_comments = Configuration::get('kgmminify_html_comments');
    	$htmlContent = str_replace(array (chr(13) . chr(10), chr(9)), array (chr(10), ''), $htmlContent);
    	$htmlContent = str_ireplace(array ('<script', '/script>', '<pre', '/pre>', '<textarea', '/textarea>', '<style', '/style>'), array ('M1N1FY-ST4RT<script', '/script>M1N1FY-3ND', 'M1N1FY-ST4RT<pre', '/pre>M1N1FY-3ND', 'M1N1FY-ST4RT<textarea', '/textarea>M1N1FY-3ND', 'M1N1FY-ST4RT<style', '/style>M1N1FY-3ND'), $htmlContent);
    	$split = explode('M1N1FY-3ND', $htmlContent);
    	$htmlContent = ''; 
    	for ($i=0; $i<count($split); $i++) {
    		$ii = strpos($split[$i], 'M1N1FY-ST4RT');
    		if ($ii !== false) {
    			$process = substr($split[$i], 0, $ii);
    			$asis = substr($split[$i], $ii + 12);
    			if (substr($asis, 0, 7) == '<script') {
    				$split2 = explode(chr(10), $asis);
    				$asis = '';
    				for ($iii = 0; $iii < count($split2); $iii ++) {
    					if ($split2[$iii]) $asis .= trim($split2[$iii]) . chr(10);
    					if ( $minify_javascript == 1 ) {
    						if (strpos($split2[$iii], '//') !== false && substr(trim($split2[$iii]), -1) == ';' ) $asis .= chr(10);
    					}
    				}
    				if ($asis) $asis = substr($asis, 0, -1);
    				if ( $minify_html_comments == 1 ) $asis = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $asis);
    				if ( $minify_javascript == 1 ) {
    					$asis = str_replace(array (';' . chr(10), '>' . chr(10), '{' . chr(10), '}' . chr(10), ',' . chr(10)), array(';', '>', '{', '}', ','), $asis);
    				}
    			} else if (substr($asis, 0, 6) == '<style') {
    				$asis = preg_replace(array ('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s'), array('>', '<', '\\1'), $asis);
    				if ( $minify_html_comments == 1 ) $asis = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $asis);
    				$asis = str_replace(array (chr(10), ' {', '{ ', ' }', '} ', '( ', ' )', ' :', ': ', ' ;', '; ', ' ,', ', ', ';}'), array('', '{', '{', '}', '}', '(', ')', ':', ':', ';', ';', ',', ',', '}'), $asis);
    			}
    		} else {
    			$process = $split[$i];
    			$asis = '';
    		}
    		$process = preg_replace(array ('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s'), array('>', '<', '\\1'), $process);
    		if ( $minify_html_comments == 1 ) $process = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $process);
    		$htmlContent .= $process.$asis;
    	}
    	$htmlContent = str_replace(array (chr(10) . '<script', chr(10) . '<style', '*/' . chr(10), 'M1N1FY-ST4RT'), array('<script', '<style', '*/', ''), $htmlContent);
    	$minify_html_xhtml = Configuration::get('kgmminify_html_xhtml');
    	$minify_html_relative = Configuration::get('kgmminify_html_relative');
    	$minify_html_scheme = Configuration::get('kgmminify_html_scheme');
    	if ( $minify_html_xhtml == 1 && strtolower( substr( ltrim( $htmlContent ), 0, 15 ) ) == '<!doctype html>' ) {
    		$htmlContent = str_replace( ' />', '>', $htmlContent );
    	}
    	if ( $minify_html_relative == 1 ) {
    		$htmlContent = str_replace( array ( 'https://' . $_SERVER['HTTP_HOST'] . '/', 'http://' . $_SERVER['HTTP_HOST'] . '/', '//' . $_SERVER['HTTP_HOST'] . '/' ), array( '/', '/', '/' ), $htmlContent );
    	}
    	if ( $minify_html_scheme == 1 ) {
    		$htmlContent = str_replace( array( 'http://', 'https://' ), '//', $htmlContent );
    	}
    	return ($htmlContent);
    }
    public function hookdisplayFooter() {
        if(version_compare("1.7.0.0", _PS_VERSION_) == 1){
            $minify_html_active = Configuration::get('kgmminify_html_active');
            if($minify_html_active){
                global $smarty;
                $smarty->registerFilter('output', array('smprestaspeed', 'minifyFullContent'));
            }
        }
    }
	public function hookdisplayBeforeBodyClosingTag() {
        if(version_compare(_PS_VERSION_,  "1.6.99.99") == 1){
            $minify_html_active = Configuration::get('kgmminify_html_active');
            if($minify_html_active){
                global $smarty;
                $smarty->registerFilter('output', array('smprestaspeed', 'minifyFullContent'));
            }
        }
	}
	public function getContent() {
		$html = '';
		if (Tools::isSubmit('save' . $this->name)) {
			$languages = Language::getLanguages(false);
            Configuration::updateValue('PS_CSS_THEME_CACHE',Tools::getvalue('PS_CSS_THEME_CACHE'));
            Configuration::updateValue('PS_JS_THEME_CACHE',Tools::getvalue('PS_JS_THEME_CACHE'));
            Configuration::updateValue('kgmminify_html_active',Tools::getvalue('minify_html_active'));
            Configuration::updateValue('kgmminify_javascript',Tools::getvalue('minify_javascript'));
            Configuration::updateValue('kgmminify_html_comments',Tools::getvalue('minify_html_comments'));
            Configuration::updateValue('kgmminify_html_xhtml',Tools::getvalue('minify_html_xhtml'));
            Configuration::updateValue('kgmminify_html_relative',Tools::getvalue('minify_html_relative'));
            Configuration::updateValue('kgmminify_html_scheme',Tools::getvalue('minify_html_scheme'));
		}

		$helper = $this->SettingForm();
		$html .= $helper->generateForm($this->fields_form);
        $html .= '<a style="margin-bottom:50px;" href="mailto:kamrulbd36@gmail.com" target="_blank"><img  style="margin-bottom:50px;" src="'.$this->_path.'/hire-us.jpg" alt="hire-us"></a>';
		return $html;
	}
}