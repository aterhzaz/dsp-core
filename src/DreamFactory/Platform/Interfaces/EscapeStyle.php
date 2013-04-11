<?php
namespace DreamFactory\Platform\Interfaces;

/**
 * EscapeStyle.php
 * Defines the various ways characters can be escaped
 *
 * This file is part of the DreamFactory Services Platform(tm) (DSP)
 * Copyright (c) 2012-2013 DreamFactory Software, Inc. <developer-support@dreamfactory.com>
 *
 * DreamFactory Services Platform(tm) <http://github.com/dreamfactorysoftware/dsp-core>
 * Copyright (c) 2012-2013 by DreamFactory Software, Inc. All rights reserved.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
interface EscapeStyle
{
	//*************************************************************************
	//* Constants
	//*************************************************************************

	/**
	 * @var int No escape (AARRGH!)
	 */
	const NONE = 0;
	/**
	 * @var int Escaped with a double character (i.e. '')
	 */
	const DOUBLED = 1;
	/**
	 * @var int Escaped with a backslash (i.e. \')
	 */
	const SLASHED = 2;
}