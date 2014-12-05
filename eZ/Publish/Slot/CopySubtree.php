<?php
/**
 * This file is part of the EzSystemsRecommendationBundle package.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 * @version //autogentag//
 */

namespace EzSystems\RecommendationBundle\eZ\Publish\Slot;

use eZ\Publish\Core\SignalSlot\Signal;
use EzSystems\RecommendationBundle\eZ\Publish\Slot;

class CopySubtree extends PersistenceAwareBase
{
    public function receive( Signal $signal )
    {
        if ( !$signal instanceof Signal\LocationService\CopySubtreeSignal )
            return;

        $contentIdArray = $this->persistenceHandler->locationHandler()->loadSubtreeIds($signal->targetNewSubtreeId);
        foreach ($contentIdArray as $contentId) {
            $this->client->updateContent( $contentId );
        }
    }
}
