<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\PlayerAuth;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Auth\AuthenticationException;

class ApiV2Controller extends Controller
{
	public function login(Request $request): PlayerAuth
	{
		$membership_id = $request->input('membership_id');
		$membership_type = $request->input('membership_type');
		$uuid = $request->input('uuid');
		if (empty($uuid)) {
			throw new AuthenticationException();
		}
		$secret = $request->input('secret');
		$access_token = $request->header('Authorization');

		$bungie_membership = null;
		$player = Player::where(['membership_id' => $membership_id, 'membership_type' => intval($membership_type)])->first();
		if (empty($player)) {
			try {
				$bungie_membership = $this->getBungieMembership($access_token, $membership_id, $membership_type);
			} catch (ClientException $e) {
				throw new AuthenticationException();
			}
			$player = Player::firstOrCreate([
				'membership_type' => $bungie_membership->membershipType,
				'membership_id' => $bungie_membership->membershipId,
			]);
		}
		$auth = PlayerAuth::where(['player_id' => $player->id, 'uuid' => $uuid, 'secret' => $secret])->first();
		if (empty($auth)) {
			if (empty($bungie_membership)) {
				try {
					$bungie_membership = $this->getBungieMembership($access_token, $membership_id, $membership_type);
				} catch (ClientException $e) {
					throw new AuthenticationException();
				}
			}

			if (empty($bungie_membership)) {
				throw new AuthenticationException();
			}
			$secret = Uuid::uuid4();
			$auth = PlayerAuth::create([
				"player_id" => $player->id,
				"uuid" => $uuid,
				"secret" => $secret->toString()
			]);
		}
		return $auth;
	}
	public function getBungieMembership($access_token, $membership_id, $membership_type)
	{

		$client = new Client();
		$membership_url = "https://www.bungie.net/Platform/User/GetMembershipsForCurrentUser/";
		$headers = [
			'X-API-Key' => env('BUNGIE_API_KEY'),
			'Authorization' => "Bearer $access_token"
		];

		$res = $client->request('GET', $membership_url, [
			'headers' => $headers
		]);
		$json = json_decode($res->getBody());
		$memberships = collect($json->Response->destinyMemberships);
		$membership = $memberships->where("membershipId", '=', $membership_id)->first();
		return $membership;
	}
}
