<?php


namespace Diginize\WpVereinsflieger\WpAdmin;


class Authentication {

	/**
	 * @param \WP_User|\WP_Error|null $user
	 * @param string $username
	 * @param string $password
	 * @return \WP_User|false The authenticated user or false if the authentication failed
	 */
	public function authenticationRequest($user, string $username, string $password) {
		// If is authenticated, allow the user to login
		if ($user instanceof \WP_User) {
			return $user;
		}

		// TODO: implement user check
		// TODO: implement add new user
		// TODO: implement update user
		// TODO: handle existing users with same email or username

		return null;
	}

	/**
	 * @param \Wp_Error $errors
	 * @param \Wp_User|false $user_data
	 */
	public function lostPasswordRequest(\Wp_Error $errors, $user_data): void {
		// TODO: check if user is allowed to reset password via wordpress
	}



}