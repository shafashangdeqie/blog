<?php
return array (	
		//应用ID,您的APPID。
		'app_id' => "2016092600599071",

		//商户私钥
		'merchant_private_key' => "MIIEpQIBAAKCAQEA0DSkMzY+deheYi4/z7Onus/9Jsvn01/mdIjXm15O/DokZwGHdTFGRvQc2R/qIAuY7zCK/DCKGtx9sxVQ6FkHhsnU58iTIZ7Ixs49p/NDC9lqP1jIQwgkulxwfA9BET2cIAujAJK31/IuJNtv1v7oV4WL3G83RZFluIFzCiffeXJpIJNoxVy0qs/oOaXXF7wAOt+X1WtwyOxdNci5ZAOkcmi1ZZNbtkYbmzWXXnWofJz576qsufLwi7BnHHuAl5gw3tH32mzG5/F6lhJ2xUQfmNAnmAc+goS5WF6/1VyIpM25bY3MdMHz4KWvQ0S5sYNVZ5dnfdBdOeV+hsiAozNlrQIDAQABAoIBAQCYLxIiOLD5AAsVGpcb20ZrfyGb3QkrcHqDjY6DCzESnfEDtZNsbsLelAoODozUNYXot4OviE86CRZ78sW7v2+H7zkG3o3k0ioRXqikfWPxYk6N1Pg0PtyRt4WkuIWn82+N4NOZVKS6XFOsLxUVgicT6hJr4oL0/6zpav1KXBC1tEBUDQwniB/oFlqKeSpwUKVaWmSpBCuY3So99vFaORjVvALxbJvX5PVWvkAc/tCaBb9BiLZt5qFH8VOKoWu3dJ2FEjElfEZUzk0/jZaX95RYcOLwUvI+fHqooQo21JKN4rKsXy6Sagi/znPt88o9e9vkez9Uzcae/514DypeckPFAoGBAOzXl7PzGXlBLPIr3i3hh4uieWg3xRrXYNxK4LNS/HcRmi0qgVuZ2NtnDZBfJooExkKCvRw1ZrgqcspgUJAhhgtoIxS/a+PE2KWX9peXX7LmCkUhSBySctqFRdX7b09HanL1oqiI/qGFQJpQlcuC/i8J7RJtddwx/wQkM5THV33XAoGBAOEMDt/ocdNCe+s8/Hjgd/FkOcrOqAbKmSFsL24onVjag86OpO47c1THvfwGRHsi4ZXBhplsU+s325knmd2Y2qRuYqAMjPlXbx46uRA2zM6lPulCrekmEYL2tlTC57/n/0n1MOyfPLJgOu8euy2ZXWXwGAbme080EB33I896a+AbAoGAcSHWpC2GSIZaet97hL0LKycUCTVCoLyq1u+pf98vG4078UExg1js3njOYN0ioqD/NzwOK1BS3bvhE0yIjyCEUCSRRVLerXEU75y0PNsg6mq6EyV/ta460KkCn+E33U3Gyl0NMqYlw2/MWSoPM6RB2KRMKxZAS0tSfl7wiKvj3gcCgYEAkUY5a+0fXWLzn51U1asBgoBSlkrlSM0MIPk3fQMW377fiz2l1mvmPXpbeA+LsXmI6iVtgCjf213Jkopv1w7PRYpEfFDdyC/a+UarJH5bo6IkhGuY3ILIlyQv+3N+KvHWaKWxGW6JvhREtwu9hOgV1LIysHGkdDKFnPJm2Y6LiLUCgYEA5NwhK80ToMuJUP+zyiVHLxb0eAI+nwQ1SKRNPGFMi+ioglz0tDXYlRF0lxGGFZNaAp0X+qTuN1aDJfn3XlHjmaeHV4W0UStKvBHJVM+DqNMEnv6pEW99N8OQ9UVl49R1qm/MtSlxGeR/c/9hpGZXOvklsfkWyypHxJdD5oHCDuM=",
		
		//异步通知地址
		'notify_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "http://www.1810.com/returnaAlipay",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0J6LetEtpsodSvEup6VU//xAzkmyxJch/o1mPkV2E20Bk9piWn0gxFHxdhrVNihp2HTmacBZe4hrdPt3qtgU5punzwmY3DEOE0IklGZ77jeuHLACLYsKnOUCwj2kAF/MMZ5XiTZT8q+NlH476yKV8RM6hZKjx2ne8Uj9ozJ1fPUnC+NELM5rP5A9Ayt5nignGuIEhLRhQ0cGlplgxa8HLzHs3tQP9xHrwZDdf0G9d32Z3E3YWUCCdEuor9ahoE9vGbRoUGg/oS+kl9V8p9IqGNBYhApJPmjjW5myz4evZpWKsQjEMUBL9UOGUXVdkeWUHTdvOE8SeL/L1s6+pkvZNwIDAQAB",
);