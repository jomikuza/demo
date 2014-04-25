CREATE TABLE my_log(
     log_id int(11) NOT NULL AUTO_INCREMENT,
     remote_addr varchar(255) NOT NULL DEFAULT '',
     request_uri varchar(255) NOT NULL DEFAULT '',
     message text NOT NULL DEFAULT '',
     sql_state text NULL DEFAULT '',
     error text NULL DEFAULT '',
     log_date timestamp NOT NULL DEFAULT NOW(),
     PRIMARY KEY  (log_id)
 ) ENGINE=MyISAM COMMENT='Log';