CREATE TABLE `api_auth` (
 `dev_id` varchar(255) NOT NULL,
 `internal_id` varchar(255) NOT NULL,
 `issuer_id` varchar(255) NOT NULL,
 `scope` json NOT NULL,
 `jwt_token_id` varchar(255) NOT NULL,
 `bearer_token` text NOT NULL,
 `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 `access_status` enum('active','expired','deactive') NOT NULL,
 PRIMARY KEY (`jwt_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

CREATE TABLE `developer_auth` (
 `dev_id` varchar(255) NOT NULL,
 `dev_email` varchar(255) NOT NULL,
 `dev_password` varchar(255) NOT NULL,
 `dev_status` enum('active','deactive') NOT NULL,
 PRIMARY KEY (`dev_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8