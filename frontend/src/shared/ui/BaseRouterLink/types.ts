import type {IProps as DefaultIProps} from "./DefaultRouterLink"
import type {IProps as DesktopNavbarIProps} from "./DesktopNavbarRouterLink"
import type {IProps as DarkBlueIProps} from "./DarkBlueRouterLink"
import {Component} from "vue";
import {AppRouteLocationRaw} from "@/shared/types/routes";

type RouterLinkType = 'default' | 'desktop-navbar' | 'dark-blue';
export type IPropsType = DefaultIProps|DesktopNavbarIProps|DarkBlueIProps;
export type BaseRouterLinkFactory = (type?: RouterLinkType) => Component<IPropsType>;

export interface IProps {
    type?:RouterLinkType
    to?: AppRouteLocationRaw
}
