<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * ErrorType enum.
 */
class ErrorType extends BaseEnum
{
    // Error messages are defined in errors.php in /resources/lang/{lang} directory.

    // Invalid request
    // 不正なリクエストです
    const CODE_4000 = '4000';

    const STATUS_4000 = 400;

    // Authentication failed
    // 認証に失敗しました
    const CODE_4010 = '4010';

    const STATUS_4010 = 401;

    // Token has expired
    // 認証トークンの有効期限が切れています
    const CODE_4011 = '4011';

    const STATUS_4011 = 401;

    // email invite has expired
    // メール招待の有効期限が切れました
    const CODE_4014 = '4014';
    const STATUS_4014 = 401;

    // Token is invalid
    // 認証トークンが無効です
    const CODE_4012 = '4012';

    const STATUS_4012 = 401;

    // Token is already used
    // この認証トークンは使用済みです
    const CODE_4013 = '4013';

    const STATUS_4013 = 401;

    // Not authorized
    // 権限がありません
    const CODE_4030 = '4030';

    const STATUS_4030 = 403;

    // Access denied
    // アクセスは拒否されました
    const CODE_4031 = '4031';

    const STATUS_4031 = 403;

    // Blocked
    // ブロックされています
    const CODE_4032 = '4032';

    const STATUS_4032 = 403;

    // Data duplicate on unique column
    const CODE_4033 = '4033';

    const STATUS_4033 = 403;

    // No account
    // アカウントは存在しません
    const CODE_4040 = '4040';

    const STATUS_4040 = 404;

    // No data
    // データが存在しません
    const CODE_4041 = '4041';

    const STATUS_4041 = 404;

    // Not logged in
    // メールアドレスの認証には事前にログインが必要です。
    const CODE_4042 = '4042';

    const STATUS_4042 = 404;

    // Invalid HTTP method
    // HTTPメソッドが不正です
    const CODE_4050 = '4050';

    const STATUS_4050 = 405;

    // This process has been already executed
    // この操作はすでに実行されています
    const CODE_4090 = '4090';

    const STATUS_4090 = 409;

    //The account cannot be registered

    const CODE_4091 = '4091';

    const STATUS_4091 = 409;

    // Validation error
    // /resources/lang/ja/validation.php messages are used
    const CODE_4220 = '4220';

    const STATUS_4220 = 422;

    // Another user is operating
    // 他のユーザが操作中です
    const CODE_4230 = '4230';

    const STATUS_4230 = 423;

    // System error
    // システムエラーが発生しました
    const CODE_5000 = '5000';

    const STATUS_5000 = 500;

    // Unexpected error
    // 予期せぬエラーが発生しました
    const CODE_5001 = '5001';

    const STATUS_5001 = 500;

    // DB error
    // DBエラーが発生しました
    const CODE_5002 = '5002';

    const STATUS_5002 = 500;

    // Registration failed
    // 登録に失敗しました
    const CODE_5003 = '5003';

    const STATUS_5003 = 500;

    // Update failed
    // 更新に失敗しました
    const CODE_5004 = '5004';

    const STATUS_5004 = 500;

    // Deletion failed
    // 削除に失敗しました
    const CODE_5005 = '5005';

    const STATUS_5005 = 500;
}
