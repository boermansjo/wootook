<?php
/**
 * This file is part of Wootook
 *
 * @license http://www.gnu.org/licenses/agpl-3.0.txt
 * @see http://www.wootook.com/
 *
 * Copyright (c) 2011-Present, Grégory PLANCHAT <g.planchat@gmail.com>
 * All rights reserved.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *                                --> NOTICE <--
 *  This file is part of the core development branch, changing its contents will
 * make you unable to use the automatic updates manager. Please refer to the
 * documentation for further information about customizing Wootook.
 *
 */
/**
 *
 * Enter description here ...
 * @author Greg
 *
 */
class Legacies_Officers_Model_Observer
{
    public static function planetUpdateListener($eventData)
    {
        if (isset($eventData['planet'])) {
            $planet = $eventData['planet'];

            $user = $planet->getUser();

            $level = floor(sqrt($user->getData('xpminier') / 500));
            if ($user->getData('lvl_minier') < $level) {
                $difference = $level - $user->getData('lvl_minier');
                if ($difference == 1) {
                    Wootook::getSession(Wootook_Empire_Model_User::SESSION_KEY)
                        ->addInfo('You gained 1 miner level.');
                } else {
                    Wootook::getSession(Wootook_Empire_Model_User::SESSION_KEY)
                        ->addInfo('You gained %1$d miner level.', (int) $difference);
                }
            }

            $level = floor(sqrt($user->getData('xpraid')));
            if ($user->getData('lvl_raid') < $level) {
                $difference = $level - $user->getData('lvl_raid');
                if ($difference == 1) {
                    Wootook::getSession(Wootook_Empire_Model_User::SESSION_KEY)
                        ->addInfo('You gained 1 raider level.');
                } else {
                    Wootook::getSession(Wootook_Empire_Model_User::SESSION_KEY)
                        ->addInfo('You gained %1$d raider level.', (int) $difference);
                }
            }
        }
    }
}