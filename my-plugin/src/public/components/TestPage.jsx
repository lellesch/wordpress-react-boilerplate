import {
    __experimentalHeading as Heading,
    __experimentalText as Text
} from '@wordpress/components';
import {__} from "@wordpress/i18n";

export const TestPage = () => {

    return (
        <>
            <Heading level={1}>
                {__('My Test Frontend Page', 'my-plugin')}
                <Text>{__('It goes...', 'my-plugin')}</Text>
            </Heading>
        </>
    )
}
