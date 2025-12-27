import {Component} from "vue";
import {DefaultRouterLink} from "./DefaultRouterLink";
import {BaseRouterLinkFactory, IPropsType} from "./types";

export const RouterLinkFactory: BaseRouterLinkFactory = (type) => {
    let component: Component<IPropsType>;

    switch (type) {
        default:
            component = DefaultRouterLink;
            break;
    }

    return component;
}