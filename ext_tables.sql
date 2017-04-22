#
# Table structure for table 'tx_sqldebug_domain_model_entity'
#
CREATE TABLE tx_sqldebug_domain_model_entity (
    uid int(11) unsigned auto_increment NOT NULL,
    pid int(11) unsigned NOT NULL,
    cruser_id int(11) unsigned NOT NULL DEFAULT '0',
    crdate int(11) unsigned NOT NULL DEFAULT '0',
    tstamp int(11) unsigned NOT NULL DEFAULT '0',
    deleted tinyint(3) NOT NULL DEFAULT '0',
    hidden tinyint(3) NOT NULL DEFAULT '0',
    
    title varchar(255) NOT NULL DEFAULT '',
    real_date DATE NOT NULL DEFAULT '1970-01-01 00:00:00',
    timestamp_date int(11) unsigned NOT NULL DEFAULT '0',
    PRIMARY KEY (uid),
    KEY parent (pid)
);
