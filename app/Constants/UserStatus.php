<?php

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

#[Constants]
class UserStatus extends AbstractConstants
{
    /**
     * @Message("正常")
     */
    const ACTIVE = 1;

    /**
     * @Message("已刪除")
     */
    const DELETED = 2;

    /**
     * @Message("已冻结")
     */
    const FREEZE = 3;
}