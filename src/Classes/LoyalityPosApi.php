<?php

namespace pneves001\loyalityposapi;

class LoyalityPosApi 
	{
	static $apiKey; 
	static $organizationId;
	static $locationId; 
	static $cashierNo;
	static $baseUrl = "https://loyality.app/pos-api";
	
	var $errors = null;
	
	/** setApiKey
	 * 
	 * Sets api access key. Or POS Software Key. 
	 * 
	 * @param type $apiKey
	 */
	public static function setApiKey($apiKey)
		{
		LoyalityPosApi::$apiKey = $apiKey; 
		}


	/** Set organization Id. 
	 * 
	 * @param type $organizationId
	 */

	public static function setOrganizationId($organizationId)
		{
		LoyalityPosApi::$organizationId = $organizationId;
		}

	/** set location id. 
	 * 
	 * @param type $location_id
	 */	
	public static function setLocationid($location_id)
		{
		LoyalityPosApi::$locationId = $location_id;
		}
		

	/** get_gift_card_load_amounts
	 * 
	 * gets the predefined gift card load amounts. 
	 * 
	 * 
	 */
	public function get_gift_card_load_amounts()
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/get-gift-card-load-amounts';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    ];
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array); 
		}

	/** get_gift_card_templates
	 * 
	 * Get gift card templates to issue virtual cards. 
	 */
	public function get_gift_card_templates()
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/get-gift-card-templates';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    ];
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array); 
		}

	/** issue gift card. 
	 * 
	 * 
	 */
	public function issue_gift_card($data)
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/issue-gift-card';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    'template_id' => $data['template_id'],
			    ];
		
		if (array_key_exists('gift_card_amount', $data))
			{
			$postData['gift_card_amount'] = $data['gift_card_amount'];
			}
		
		else 
			{
			$this->errors = "No gift card method provided.";
			
			return false;
			}
			
		if (array_key_exists('email', $data))
			{
			$postData['email'] = $data['email'];
			}
			
		elseif(array_key_exists('phone', $data))
			{
			$postData['phone'] = $data;
			}
			
		else 
			{
			$this->errors = "no recipient method provided. Please add either an email or phone number"; 
			
			return false;
			}
		
		if (array_key_exists('message', $data))
			{
			$postData['message'] = $data['message'];
			}
		
		if (array_key_exists('recipient_name', $data))
			{
			$postData['recipient_name'] = $data['recipient_name'];
			}
		
		if (isset(LoyalityPosApi::$locationId))
			{
			$postData['location_id'] = LoyalityPosApi::$locationId; 
			}
			
		if (isset(LoyalityPosApi::$cashierNo))
			{
			$postData['cashier_no'] = LoyalityPosApi::$cashierNo; 
			}
			
			
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		if ($array['success'] == false)
			{
			$this->errors = $array['errors']; 
			
			return false;
			}
		
		return collect($array); 
		}
		
		
	public function get_first_inactive_card()
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/get-first-inactive-card';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    ];
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array); 
		}
		
		
	public function validate_gift_card_ccv($gift_card_id, $ccv)
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/validate-gift-card-ccv';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    'gift_card_id' => $gift_card_id,
			    'ccv' => $ccv
			    ];
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array);
		}
		
	public function activate_gift_card($gift_card_id, $ccv, $email, $phone, $amount)
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/activate-giftcard';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    'gift_card_id' => $gift_card_id,
			    'ccv' => $ccv,
			    'amount' => $amount
			    ];
		
		if (!empty($email))
			{
			$postData['email'] = $email;
			}
		
			
		if (!empty($phone))
			{
			$postData['phone'] = $phone;
			}
			
		if (isset(LoyalityPosApi::$locationId))
			{
			$postData['location_id'] = LoyalityPosApi::$locationId; 
			}
			
		if (isset(LoyalityPosApi::$cashierNo))
			{
			$postData['cashier_no'] = LoyalityPosApi::$cashierNo; 
			}
			
			
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array);
		}
		
	public function unlock_gift_card($gift_card_id)
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/unlock-card';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    'gift_card_id' => $gift_card_id
			    ];
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array);
		}
		
	public function find_gift_card($gift_card_id)
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/find-gift-card';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    'gift_card_id' => $gift_card_id
			    ];
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array);
		}
		
	public function credit_gift_card($gift_card_id, $ccv, $amount)
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/credit-gift-card';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    'gift_card_id' => $gift_card_id,
			    'ccv' => $ccv,
			    'amount' => $amount
			    ];
		
		if (isset(LoyalityPosApi::$locationId))
			{
			$postData['location_id'] = LoyalityPosApi::$locationId; 
			}
			
		if (isset(LoyalityPosApi::$cashierNo))
			{
			$postData['cashier_no'] = LoyalityPosApi::$cashierNo; 
			}
			
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array);
		}
		
	public function debit_gift_card($gift_card_id, $ccv, $amount)
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/debit-gift-card';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    'gift_card_id' => $gift_card_id,
			    'ccv' => $ccv,
			    'amount' => $amount
			    ];
		
		if (isset(LoyalityPosApi::$locationId))
			{
			$postData['location_id'] = LoyalityPosApi::$locationId; 
			}
			
		if (isset(LoyalityPosApi::$cashierNo))
			{
			$postData['cashier_no'] = LoyalityPosApi::$cashierNo; 
			}
			
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array);
		}
		
		
	public function get_gift_card_history($gift_card_id)
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/get-gift-card-history';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    'gift_card_id' => $gift_card_id
			    ];
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array);
		}
		
		
	public function get_voucher_block_list()
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/get-voucher-block-list';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId
			    ];
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array);
		}
		
	public function get_voucher_info($voucher_id)
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/get-voucher-info';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    'voucher_id' => $voucher_id
			    ];
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array);
		}
		
	public function issue_voucher($voucher_block_id, $email, $phone)
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/issue-voucher';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    'voucher_id' => $voucher_block_id
			    ];
		
		if (isset(LoyalityPosApi::$locationId))
			{
			$postData['location_id'] = LoyalityPosApi::$locationId; 
			}
			
		if (isset(LoyalityPosApi::$cashierNo))
			{
			$postData['cashier_no'] = LoyalityPosApi::$cashierNo; 
			}
		
			
		if (!empty($email))
			{
			$postData['email'] = $email;
			}
		
			
		if (!empty($phone))
			{
			$postData['phone'] = $phone;
			}
				
			
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array);
		}

		
	public function redeem_voucher($voucher_id, $ccv)
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/redeem-voucer';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    'sold_voucher_id' => $voucher_id,
			    'ccv' => $ccv
			    ];
		
		if (isset(LoyalityPosApi::$locationId))
			{
			$postData['location_id'] = LoyalityPosApi::$locationId; 
			}
			
		if (isset(LoyalityPosApi::$cashierNo))
			{
			$postData['cashier_no'] = LoyalityPosApi::$cashierNo; 
			}
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array);
		}
		
	public function issue_points_acocunt($email, $phone)
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/issue-points-account';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId			    
			    ];
		
		if (isset($phone))
			{
			$postData['phone'] = $phone;
			}
			
		if (isset($email))
			{
			$postData['email'] = $email;
			}
			
		if (isset(LoyalityPosApi::$locationId))
			{
			$postData['location_id'] = LoyalityPosApi::$locationId; 
			}
			
		if (isset(LoyalityPosApi::$cashierNo))
			{
			$postData['cashier_no'] = LoyalityPosApi::$cashierNo; 
			}
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array);
		}
		
	public function credit_points_account($points_account_id, $purchase_amount)
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/points-credit-account';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    'points_account_id' => $points_account_id,
			    'purchase_amount' => $purchase_amount
			    ];
		
		if (isset(LoyalityPosApi::$locationId))
			{
			$postData['location_id'] = LoyalityPosApi::$locationId; 
			}
			
		if (isset(LoyalityPosApi::$cashierNo))
			{
			$postData['cashier_no'] = LoyalityPosApi::$cashierNo; 
			}
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array);
		}
		
	public function debit_points_account($points_account_id, $points)
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/points-credit-account';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    'points_account_id' => $points_account_id,
			    'points' => $points
			    ];
		
		if (isset(LoyalityPosApi::$locationId))
			{
			$postData['location_id'] = LoyalityPosApi::$locationId; 
			}
			
		if (isset(LoyalityPosApi::$cashierNo))
			{
			$postData['cashier_no'] = LoyalityPosApi::$cashierNo; 
			}
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array);
		}
		
	public function get_points_balance($points_account_id)
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/get-points-balance';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    'points_account_id' => $points_account_id
			    ];
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array);
		}
		
	public function issue_stamp_card($email, $phone)
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/issue-stamp-card';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId			    
			    ];
		
		if (isset($phone))
			{
			$postData['phone'] = $phone;
			}
			
		if (isset($email))
			{
			$postData['email'] = $email;
			}
			
		if (isset(LoyalityPosApi::$locationId))
			{
			$postData['location_id'] = LoyalityPosApi::$locationId; 
			}
			
		if (isset(LoyalityPosApi::$cashierNo))
			{
			$postData['cashier_no'] = LoyalityPosApi::$cashierNo; 
			}
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array);
		}
		
	public function get_stamp_card_info($stamp_card_id)
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/get-stamp-card-info';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    'stamp_card_id' => $stamp_card_id 
			    ];
		
		if (isset(LoyalityPosApi::$locationId))
			{
			$postData['location_id'] = LoyalityPosApi::$locationId; 
			}
			
		if (isset(LoyalityPosApi::$cashierNo))
			{
			$postData['cashier_no'] = LoyalityPosApi::$cashierNo; 
			}
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array);
		}
		
	public function stamp_loyalty_card($stamp_card_id)
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/stamp-loyalty-card';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    'stamp_card_id' => $stamp_card_id 
			    ];

		if (isset(LoyalityPosApi::$locationId))
			{
			$postData['location_id'] = LoyalityPosApi::$locationId; 
			}
			
		if (isset(LoyalityPosApi::$cashierNo))
			{
			$postData['cashier_no'] = LoyalityPosApi::$cashierNo; 
			}
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array);
		}
		
	public function redeam_loyalty_card($stamp_card_id)
		{
		$handle = curl_init();
		
		$url = LoyalityPosApi::$baseUrl . '/stamp-loyalty-card';
		
		$postData = [
			    'api_key' => LoyalityPosApi::$apiKey,
			    'organization_id' => LoyalityPosApi::$organizationId,
			    'stamp_card_id' => $stamp_card_id 
			    ];

		if (isset(LoyalityPosApi::$locationId))
			{
			$postData['location_id'] = LoyalityPosApi::$locationId; 
			}
			
		if (isset(LoyalityPosApi::$cashierNo))
			{
			$postData['cashier_no'] = LoyalityPosApi::$cashierNo; 
			}
		
		$opts = [
			CURLOPT_URL => $url,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_RETURNTRANSFER => true
			];
		
		curl_setopt_array($handle, $opts);
			
		curl_setopt($handle, CURLOPT_URL, $url); 
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		
		$output = curl_exec($handle); 
		
		curl_close($handle);
		
		$array = json_decode($output, true); 
		
		return collect($array);
		}
	}


