<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => "The :attribute must be accepted.",
	"active_url"           => "The :attribute is not a valid URL.",
	"after"                => "The :attribute must be a date after :date.",
	"alpha"                => "The :attribute may only contain letters.",
	"alpha_dash"           => "The :attribute may only contain letters, numbers, and dashes.",
	"alpha_num"            => "The :attribute may only contain letters and numbers.",
	"array"                => "The :attribute must be an array.",
	"before"               => "The :attribute must be a date before :date.",
	"between"              => [
		"numeric" => "The :attribute must be between :min and :max.",
		"file"    => "The :attribute must be between :min and :max kilobytes.",
		"string"  => "The :attribute must be between :min and :max characters.",
		"array"   => "The :attribute must have between :min and :max items.",
	],
	"boolean"              => "The :attribute field must be true or false.",
	"confirmed"            => "The :attribute confirmation does not match.",
	"date"                 => "The :attribute is not a valid date.",
	"date_format"          => "The :attribute does not match the format :format.",
	"different"            => "The :attribute and :other must be different.",
	"digits"               => "The :attribute must be :digits digits.",
	"digits_between"       => "The :attribute must be between :min and :max digits.",
	"email"                => "メールアドレスが正しくありません。",
	"filled"               => "The :attribute field is required.",
	"exists"               => "The selected :attribute is invalid.",
	"image"                => "The :attribute must be an image.",
	"in"                   => "The selected :attribute is invalid.",
	"integer"              => "The :attribute must be an integer.",
	"ip"                   => "The :attribute must be a valid IP address.",
	"max"                  => [
		"numeric" => "The :attribute may not be greater than :max.",
		"file"    => "The :attribute may not be greater than :max kilobytes.",
		"string"  => "The :attribute may not be greater than :max characters.",
		"array"   => "The :attribute may not have more than :max items.",
	],
	"mimes"                => "The :attribute must be a file of type: :values.",
	"min"                  => [
		"numeric" => "The :attribute must be at least :min.",
		"file"    => "The :attribute must be at least :min kilobytes.",
		"string"  => "The :attribute must be at least :min characters.",
		"array"   => "The :attribute must have at least :min items.",
	],
	"not_in"               => "The selected :attribute is invalid.",
	"numeric"              => "The :attribute must be a number.",
	"regex"                => "The :attribute format is invalid.",
	"required"             => ":attribute フィールドは必須です。",
	"required_if"          => "The :attribute field is required when :other is :value.",
	"required_with"        => "The :attribute field is required when :values is present.",
	"required_with_all"    => "The :attribute field is required when :values is present.",
	"required_without"     => "The :attribute field is required when :values is not present.",
	"required_without_all" => "The :attribute field is required when none of :values are present.",
	"same"                 => "The :attribute and :other must match.",
	"size"                 => [
		"numeric" => "The :attribute must be :size.",
		"file"    => "The :attribute must be :size kilobytes.",
		"string"  => "The :attribute must be :size characters.",
		"array"   => "The :attribute must contain :size items.",
	],
	"unique"               => ":attribute に入力されている値はすでに登録されています。",
	"url"                  => "The :attribute format is invalid.",
	"timezone"             => "The :attribute must be a valid zone.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	// 'custom' => [
	// 	'attribute-name' => [
	// 		'rule-name' => 'custom-message',
	// 	],
	// ],


	'custom' => [
		//登録バリデーション
		'email' => [
			'required' => 'メールアドレスの入力は必須です。',
			'email'    => '不正なメールアドレスです。',
			'max'      => 'メールアドレスは255文字以下で入力してください。',
			'unique'   => '入力されたメールアドレスは既にご利用されています。',
		],
		'avatar' => [
			'max' 	=> 'アップロードできるサイズを超えています。',
			'image' => '画像ファイル以外が指定されています。',
			'mimes' => 'アップロードできる画像は、「jpg,png,gif」のみです。',
		],
		'avatar_url' => [
			'string' => '画像リンクが不正です。お手数ですが、時間を置いて再登録していただくか、別の方法で新規登録を行ってください。',
			'url' 	 => '画像URLが不正です。お手数ですが、時間を置いて再登録していただくか、別の方法で新規登録を行ってください。',
		],
		'name' => [
			'required' => 'ユーザーネームは必須です。',
			'max' 	   => 'ユーザーネームは20文字以内でなくてはいけません。',
			'unique' => '入力されたユーザーネームは既に登録されています。',
		],
		'password' => [
			'required' => 'パスワードの入力は必須です。',
			'confirmed' => 'パスワードが一致しません。',
			'min' => 'パスワードは少なくとも6文字以上でなくてはいけません。',
		],
		'entrance_year' => [
			'required' => '入学年度は必須です。',
		],
		'faculty' => [
			'required' => '学部は必須です。',
		],
		'sex' => [
			'required' => '性別は必須です。',
		],
		//レビューバリデーション
		'grade' => [
			'required' => '「受講時の学年」が選択されていません。',
		],
		'stars' => [
			'required' => '「総合評価度」が選択されていません。',
		],
		'unit_stars' => [
			'required' => '「単位の取りやすさ」が選択されていません。',
		],
		'grade_stars' => [
			'required' => '「GP(成績)の取りやすさ」が選択されていません。',
		],
		'fulfill' => [
			'required' => '「内容の充実度」が選択されていません。',
		],
		'diff_teacher' => [
			'required' => '「現在の講師と異なる」が選択されていません。',
		],
		'review_comment' => [
			'required' => '「授業の感想」が入力されていません。',
			'min'	   => '「授業の感想」は10文字以上で入力してください。',
			'max'	   => '「授業の感想」は500文字以上で入力してください。',
		],
		//お問い合わせバリデーション
		'inquiry_text' => [
			'required' => '「お問い合わせ内容」が入力されていません。',
			'max'		=>	'「お問い合わせ内容」は1000字以下で入力してください。',
		],
		'category' => [
			'required' => '「カテゴリ」が選択されていません。',
		],

	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [],

];
